package com.flushout.fomonitor;

import static android.view.WindowManager.LayoutParams.TYPE_SYSTEM_ALERT;

import java.lang.reflect.Method;
import java.util.ArrayList;
import java.util.List;

import com.flushout.fomonitor.MainActivity;
//import com.flushout.fomonitor.PasswordActivity;
import com.flushout.fomonitor.R;
//import com.flushout.fomonitor.SettingsActivity;
//import com.flushout.fomonitor.UserInfoActivity;
import com.flushout.fomonitor.RegisterActivity;
import com.flushout.fomonitor.Adapters.AppsAdapter;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.General.RequestPassword;
import com.flushout.fomonitor.Models.AppInfo;
import com.flushout.fomonitor.Models.Applications;
import com.flushout.fomonitor.Models.AppsModel;
import com.flushout.fomonitor.Models.UserCompanySettings;
import com.flushout.fomonitor.Models.UserInfo;
import com.flushout.fomonitor.Tracking.Tracker;
import com.flushout.fomonitor.WebService.SyncReceiver;
import com.flushout.fomonitor.WebService.Synchronize;

import android.app.Activity;
import android.app.KeyguardManager;
import android.app.ProgressDialog;
import android.app.KeyguardManager.KeyguardLock;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.Display;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.GridView;
import android.widget.AdapterView.OnItemClickListener;

public class MainActivity extends Activity {

	final Context context = this;
	
	AppsAdapter appAdapter = null; 
	public Runnable viewApps = null;
	ArrayList<AppInfo> packageList = null;
	ArrayList<AppInfo> allowedApps = new ArrayList<AppInfo>();
	Applications myApps = null;
	Tracker gps;
	private int currentApiVersion = android.os.Build.VERSION.SDK_INT;
	GridView gridview;
	
	ProgressDialog progressDialog;
	SyncReceiver receiver;
	
	private static MainActivity instance = null;

	public static MainActivity getInstance()
	{
		return instance;
	}
	
	@SuppressWarnings("deprecation")
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
		this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

		setContentView(R.layout.activity_main);
		Log.d("FomonitorLog", "MainActivity->onCreate->1");
		instance = this;
		General.setAppContext(getApplicationContext());
		Log.d("FomonitorLog", "MainActivity->onCreate->2");
		IntentFilter filter = new IntentFilter(SyncReceiver.ACTION_RESP);
		Log.d("FomonitorLog", "MainActivity->onCreate->3");
        filter.addCategory(Intent.CATEGORY_DEFAULT);
        Log.d("FomonitorLog", "MainActivity->onCreate->4");
        receiver = new SyncReceiver();
        Log.d("FomonitorLog", "MainActivity->onCreate->4");
        registerReceiver(receiver, filter);
        Log.d("FomonitorLog", "MainActivity->onCreate->5");
		
		if (!General.isDefaultLauncher())
		{
			Log.d("FomonitorLog", "MainActivity->onCreate->6");
			getPackageManager().clearPackagePreferredActivities(getPackageName());
			
		}
		Log.d("FomonitorLog", "MainActivity->onCreate->7");
		// Request PIN
/*		IntentFilter onLockOnFilter = new IntentFilter(Intent.ACTION_SCREEN_ON);
		onLockOnFilter.addAction(Intent.ACTION_SCREEN_OFF);
		BroadcastReceiver kgReceiver = new RequestPassword();
		registerReceiver(kgReceiver, onLockOnFilter);*/
		
		// Disable Keyguard
		KeyguardManager keyguardManager = (KeyguardManager)getSystemService(Activity.KEYGUARD_SERVICE);
		Log.d("FomonitorLog", "MainActivity->onCreate->9");
		KeyguardLock lock = keyguardManager.newKeyguardLock(KEYGUARD_SERVICE);
		Log.d("FomonitorLog", "MainActivity->onCreate->10");
		lock.disableKeyguard();
		Log.d("FomonitorLog", "MainActivity->onCreate->11");
		
		if (checkUserSet())
		{
			if(UserInfo.getStatusConf()){
				if(UserCompanySettings.get_instance().statusPayment != 0){
					Log.d("FomonitorLog", "MainActivity->onCreate->12");
					gps = new Tracker(this);
					Log.d("FomonitorLog", "MainActivity->onCreate->12.1");
					int width;
					Display display = getWindowManager().getDefaultDisplay();
					width = display.getWidth();
					Log.d("FomonitorLog", "MainActivity->onCreate->12.2");
					packageList = new ArrayList<AppInfo>();
					appAdapter = new AppsAdapter(this, R.layout.applist, packageList);
					Log.d("FomonitorLog", "MainActivity->onCreate->12.3");
					gridview = (GridView) findViewById(R.id.menuGridView);
					gridview.setAdapter(appAdapter);
					Log.d("FomonitorLog", "MainActivity->onCreate->12.4");
					Log.d("","width Display -> "+display.getWidth());
					Log.d("","gridview.getPaddingLeft -> "+gridview.getPaddingLeft());
					Log.d("","gridview.getPaddingRight -> "+gridview.getPaddingRight());
					Log.d("xxxxxxxxxx","width -> " + (((width-gridview.getPaddingLeft()-gridview.getPaddingRight())/2)-10) + "");
					int colW = ((width-gridview.getPaddingLeft()-gridview.getPaddingRight())/2)-10;
				    gridview.setColumnWidth(colW);
				    Log.d("FomonitorLog", "MainActivity->onCreate->12.5");
				    viewApps = new Runnable()
				    {
						public void run()
						{
							getApps();
						}
					};
					Log.d("FomonitorLog", "MainActivity->onCreate->12.6");
					Thread appLoaderThread = new Thread(null, viewApps, "AppLoaderThread");
					appLoaderThread.start();
					Log.d("FomonitorLog", "MainActivity->onCreate->12.7");
					progressDialog = ProgressDialog.show(MainActivity.this, getResources().getString(R.string.hold_on), getResources().getString(R.string.loading_apps), true);
					Log.d("FomonitorLog", "MainActivity->onCreate->12.8");
					Synchronize.startTasks();
					//General.checkUpdate();
					Log.d("FomonitorLog", "MainActivity->onCreate->12.9");
					
					gridview.setOnItemClickListener(new OnItemClickListener() 
				    {
				        public void onItemClick(AdapterView<?> parent, View v, int position, long id) 
				        {
				        	openApp(position);
			 	        }
				    });
				}else{
					Log.d("FomonitorLog", "MainActivity->onCreate->13");
					initPendingPayment();
					Log.d("FomonitorLog", "MainActivity->onCreate->14");
					finish();
				}
			}else{
				Log.d("FomonitorLog", "MainActivity->onCreate->13");
				initAuthentication();
				Log.d("FomonitorLog", "MainActivity->onCreate->14");
				finish();
			}
		}
		else
		{
			Log.d("FomonitorLog", "MainActivity->onCreate->13");
			initWizard();
			Log.d("FomonitorLog", "MainActivity->onCreate->14");
			finish();
		}
		
		
	}
	
	@Override
	public void onPause()
	{
		super.onPause();
		if(progressDialog != null) progressDialog.dismiss();
	}
	
	public void updateAppListOnMainThread()
	{
		progressDialog = ProgressDialog.show(MainActivity.this, getResources().getString(R.string.hold_on), getResources().getString(R.string.loading_apps_update), true);
		
		if (null != gridview) 
		{
			appAdapter.clear();
			appAdapter.notifyDataSetChanged();
			gridview.invalidateViews();
		}
		
		Thread appLoaderThread = new Thread(null, viewApps, "AppLoaderThread");
		appLoaderThread.start();
	}

	@Override
	public void onResume()
	{
		super.onResume();
		/*
		if (checkUserSet()) 
		{
			DeviceInfo.forceGPS();
		}
		*/
		
		General.currentInstance = this;
	}
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) 
	{
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}
	
	@Override
	public boolean onOptionsItemSelected(MenuItem item) 
	{
	    switch (item.getItemId()) {
	        case R.id.action_setting:
	        	Log.d("FomonitorLog", "MainActivity->onOptionsItemSelected->action_settings");
	        	Intent intentSettings = new Intent(this, SettingActivity.class);
	            startActivity(intentSettings);
	            
	            return true;
	        case R.id.action_user:
	        	Log.d("FomonitorLog", "MainActivity->onOptionsItemSelected->action_user");
	        	Intent intentInfo = new Intent(this, UserActivity.class);
	            startActivity(intentInfo);
	            
	            return true;
	            
	        case R.id.action_unlock:
	        	Log.d("FomonitorLog", "MainActivity->onOptionsItemSelected->action_unlock");
	        	Intent intentPassword = new Intent(this, UnlockActivity.class);
	        	intentPassword.putExtra("unlock", true);
	            startActivity(intentPassword);
	            
	            return true;
	        default:
	        	Log.d("FomonitorLog", "MainActivity->onOptionsItemSelected->default");
	            return super.onOptionsItemSelected(item);
	    }
	}
	
	@Override
	public void onWindowFocusChanged(boolean hasFocus)
	{
		Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->begin");
		try
		{
			Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->try");
			if(!hasFocus)
			{
				Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 1");
				Object service  = getSystemService("statusbar");
				Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 2");
				Class<?> statusbarManager = Class.forName("android.app.StatusBarManager");
				Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 3");
			    if (currentApiVersion <= 16) {
			    	Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 4");
			    	Method collapse = statusbarManager.getMethod("collapse");
			    	Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 5");
			        collapse.setAccessible(false);
			        Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 6");
			    	collapse.invoke(service);
			        Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->if 7");
			    } else {
			    	Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->else 4");
			        Method collapse2 = statusbarManager.getMethod("collapsePanels");
			        Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->else 5");
			        collapse2.setAccessible(false);
			        Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->else 6");
			        collapse2.invoke(service);
			    }
			}
		}
		catch(Exception ex)
		{
			Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->catch");
			ex.printStackTrace();
		}
		Log.d("FomonitorLog", "MainActivity->onWindowFocusChanged->end");
	}
	
	@Override
	public void onBackPressed() 
	{
	}
	
	public Context getActivityContext()
	{
		return MainActivity.this;
	}
	
	/*
	 * Application list
	 */
	
	private void getApps()
	{
		try
		{
			myApps = new Applications(getPackageManager());
			packageList = myApps.getPackageList();
		}
		catch(Exception e)
		{
			e.printStackTrace();
		}
		
		this.runOnUiThread(returnAppList);
	}
	
	private Runnable returnAppList = new Runnable()
	{
		public void run()
		{
			List<String> allowedPackages = AppsModel.get_model().listPackages();
			
			if(packageList != null && packageList.size() > 0)
			{
				allowedApps.clear();
				final PackageManager pm = getPackageManager();
			//	appAdapter.notifyDataSetChanged();
				
				for(int i = 0; i < packageList.size(); ++i)
				{
					String thePackage = packageList.get(i).packageName;
					if (pm.getLaunchIntentForPackage(thePackage)!=null)
					{
						if (allowedPackages.contains(thePackage))
						{
							allowedApps.add(packageList.get(i));
							appAdapter.add(packageList.get(i));
						}
					}
				}
			}
			progressDialog.dismiss();
			appAdapter.notifyDataSetChanged();
		}
	};
		
	private void openApp(int i)
	{
		Log.d("FomonitorLog", "MainActivity->openApp->begin");
		AppInfo ainfo = allowedApps.get(i);
		Log.d("FomonitorLog", "MainActivity->openApp->1");
		Intent launchApp = getPackageManager().getLaunchIntentForPackage(ainfo.packageName);
		Log.d("FomonitorLog", "MainActivity->openApp->2");
		if (launchApp != null) 
		{
			Log.d("FomonitorLog", "MainActivity->openApp->3");
			if(ainfo.packageName.equals("com.android.camera"))
			{ //Camera
				Log.d("FomonitorLog", "MainActivity->openApp->3.1");
				launchApp = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
			}
			Log.d("FomonitorLog", "MainActivity->openApp->4");
			if (ainfo.packageName.equals("com.android.settings")) {
				Log.d("FomonitorLog", "MainActivity->openApp->4.1");
				launchApp = new Intent(android.provider.Settings.ACTION_SETTINGS);
			}
			Log.d("FomonitorLog", "MainActivity->openApp->5");
			if (ainfo.packageName.equals("com.android.contacts")) {
				Log.d("FomonitorLog", "MainActivity->openApp->5.1");
				launchApp = new Intent();
				launchApp.setAction(Intent.ACTION_VIEW);
				launchApp.setData(Uri.parse("content://contacts/people/"));
			}
			Log.d("FomonitorLog", "MainActivity->openApp->6");
			if (ainfo.packageName.equals("com.android.phone")) {
				Log.d("FomonitorLog", "MainActivity->openApp->6.1");
				launchApp = new Intent();
				launchApp.setAction(Intent.ACTION_DIAL);
			}
			Log.d("FomonitorLog", "MainActivity->openApp->7");
			launchApp.addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP);
			launchApp.addFlags(Intent.FLAG_ACTIVITY_EXCLUDE_FROM_RECENTS);
			startActivity(launchApp);
			Log.d("FomonitorLog", "MainActivity->openApp->8");
		}
		else
		{
			if(ainfo.packageName.equals("com.android.camera"))
			{
				launchApp = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
			}
			
			if (ainfo.packageName.equals("com.android.settings")) 
			{
				launchApp = new Intent(android.provider.Settings.ACTION_SETTINGS);
			}
	
			if (ainfo.packageName.equals("com.android.contacts")) 
			{
				launchApp = new Intent();
				launchApp.setAction(Intent.ACTION_VIEW);
				launchApp.setData(Uri.parse("content://contacts/people/"));
			}
			
			if (ainfo.packageName.equals("com.android.phone")) 
			{
				launchApp = new Intent();
				launchApp.setAction(Intent.ACTION_DIAL);
			}
			
			if (launchApp!= null) {
				launchApp.addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP);
				launchApp.addFlags(Intent.FLAG_ACTIVITY_EXCLUDE_FROM_RECENTS);
				startActivity(launchApp);
			}
		}
	}
	
	/*
	 * Check if there is a registered user
	 */
	
	public boolean checkUserSet()
	{
		if (UserInfo.getUserName().isEmpty())
			return false;
		else
			return true;
	}
	
	public void initWizard()
	{
		Intent intentWizard = new Intent(this, RegisterActivity.class);
        startActivity(intentWizard);
	}
	
	public void initAuthentication()
	{
		Intent intentAuthentication = new Intent(this, AuthenticationActivity.class);
        startActivity(intentAuthentication);
	}
	
	public void initPendingPayment()
	{
		Intent intentPendingPaymentActivity = new Intent(this, PendingPaymentActivity.class);
        startActivity(intentPendingPaymentActivity);
	}
	
	@Override
	public void onDestroy()
	{
		super.onDestroy();
		unregisterReceiver(receiver);
	}

}
