package com.flushout.fomonitor.General;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.Application;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.pm.ResolveInfo;
import android.net.ConnectivityManager;
import android.net.Uri;
import android.util.Log;

import com.flushout.fomonitor.MainActivity; //import com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.R;
import com.flushout.fomonitor.WebService.Synchronize;

@SuppressLint("SimpleDateFormat")
public class General extends Application 
{
	public static Activity currentInstance;
	
	private static Context context;
	final static int CURRENT_VERSION = 2;
	
	@Override
	public void onCreate()
	{
		super.onCreate();
		General.context = getApplicationContext();
	}

	public static void setAppContext(Context ctx)
	{
		General.context = ctx;
	}
	
	public static Context getAppContext() 
	{
		return General.context;
	}
	 
	public static int getCurrentVersion()
	{
		return CURRENT_VERSION; 
	}
	
	public static double getDistanceInMeters(double lat1, double lon1, double lat2, double lon2)
	{
		double raioDaTerraEmKm = 6371;
		double dLat = (lat2-lat1)*  Math.PI / 180;
		double dLon = (lon2-lon1)* Math.PI / 180;
		double l1 = lat1 * Math.PI / 180;
		double l2 = lat2 * Math.PI / 180;
		    
		double a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(l1) * Math.cos(l2);
		double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
		double d = raioDaTerraEmKm * c;
		    
		return d*1000;
	}
	 
	public static String addSlashes(String str)
	{
		if(str==null) return "";

		StringBuffer s = new StringBuffer ((String) str);
		for (int i = 0; i < s.length(); i++)
			if (s.charAt (i) == '\'')
				s.insert (i++, '\'');
		return s.toString();
	 }
	
	public static boolean int2bool(int val)
	{
		if (val==0)
			return false;
		else
			return true;
	}
	
	public static void alertError(Context ctx, String title, String message)
	{
		AlertDialog.Builder alertDialog = new AlertDialog.Builder(ctx);
	    
    	alertDialog.setTitle(title);
    	alertDialog.setMessage(message);
    
    	alertDialog.setPositiveButton(ctx.getString(R.string.close), new DialogInterface.OnClickListener() 
    	{
			@Override
			public void onClick(DialogInterface dialog, int which) 
			{
							
			}
		});
   
    	alertDialog.create().show();
	}

	
	public static String capitalize(String s) 
	{
		if (s == null || s.length() == 0) 
		{
			return "";
		}
		char first = s.charAt(0);
		
		if (Character.isUpperCase(first)) 
			return s;
		else
			return Character.toUpperCase(first) + s.substring(1);
	}
	
	public static String getDateTimeString()
	{
		Calendar datetime = Calendar.getInstance(); 
		String date = new SimpleDateFormat("yyyyMMddhhmmss").format(datetime.getTime());
		return date;
	}
	
	public static String getDefaultLauncher()
	{
		final Intent intent = new Intent(Intent.ACTION_MAIN); 
	    intent.addCategory(Intent.CATEGORY_HOME); 
	    final ResolveInfo res = General.getAppContext().getPackageManager().resolveActivity(intent, 0);
	    
	    return res.activityInfo.packageName;
	}
	
	public static boolean isDefaultLauncher() 
	{
	    final IntentFilter filter = new IntentFilter(Intent.ACTION_MAIN);
	    filter.addCategory(Intent.CATEGORY_HOME);

	    List<IntentFilter> filters = new ArrayList<IntentFilter>();
	    filters.add(filter);

	    final String myPackageName = General.getAppContext().getPackageName();
	    
	     
	    
	    return getDefaultLauncher().equals(myPackageName);
	    
	}
	
	public static void checkUpdate()
	{
		Log.d("FomonitorLog", "General->checkUpdate->begin");
		int newVersion = Synchronize.downloadVersion();
		Log.d("FomonitorLog", "General->checkUpdate->1 CURRENT_VERSION="+CURRENT_VERSION+" newVersion="+newVersion);
		if (CURRENT_VERSION < newVersion)
		{
			Log.d("FomonitorLog", "General->checkUpdate->2");
			AlertDialog.Builder alertDialog = new AlertDialog.Builder(MainActivity.getInstance().getActivityContext());
			Log.d("FomonitorLog", "General->checkUpdate->3");
	    	alertDialog.setTitle("Atualiza?‹o");
	    	alertDialog.setMessage("H‡ uma nova vers‹o do ACView diposn’vel.");
	    	Log.d("FomonitorLog", "General->checkUpdate->4");
	    	alertDialog.setPositiveButton("Atualizar", new DialogInterface.OnClickListener() 
	    	{
				@Override
				public void onClick(DialogInterface dialog, int which) 
				{
					Intent i = new Intent(Intent.ACTION_VIEW, Uri.parse(""));//"http://acview.airclic.net.br/ACView.apk"
					MainActivity.getInstance().getActivityContext().startActivity(i);
				}
			});
	   
	    	alertDialog.create().show();
		}
		Log.d("FomonitorLog", "General->checkUpdate->end");
	}
	
	
	public static boolean areEqualLists(List<String> array1, List<String> array2)
	{
		if (array1.size() != array2.size())
			return false;
		else
		{
			array1.removeAll(array2);		
			boolean isEqual = (array1.size()==0);
			
			return isEqual;
		}
	}

	public static boolean CheckInternet() 
	{
	    ConnectivityManager connec = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
	    android.net.NetworkInfo wifi = connec.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
	    android.net.NetworkInfo mobile = connec.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);

	    // Here if condition check for wifi and mobile network is available or not.
	    // If anyone of them is available or connected then it will return true, otherwise false;

	    if (wifi.isConnected() || mobile.isConnected()) {
	        return true;
	    } 
	    return false;
	}
	
}
