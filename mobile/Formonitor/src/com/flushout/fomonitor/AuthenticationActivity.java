package com.flushout.fomonitor;

import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.General.InternetStatus;
import com.flushout.fomonitor.Models.UserInfo;
import com.flushout.fomonitor.WebService.Synchronize;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class AuthenticationActivity extends ActionBarActivity {
	private EditText txtCodAuthentication;
	String user_name = "";
	String companyName = "";
	String user_email = "";
	ProgressDialog  dialog;
	Runnable registerTask = null;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		Log.d("AuthenticationActivity", "1");
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.authentication_activity);
		Log.d("AuthenticationActivity", "2");		
		
		Intent intent = this.getIntent();
		Log.d("AuthenticationActivity", "4");
		user_name = intent.getStringExtra("user_name");
		companyName = intent.getStringExtra("companyName");
		user_email = intent.getStringExtra("user_email");

		Log.d("AuthenticationActivity", "6");
		//Wizard_Open.pin 
		Button btnNext = (Button) findViewById(R.id.btnNext);
		Log.d("AuthenticationActivity", "8");
		txtCodAuthentication = (EditText) findViewById(R.id.txtCodAuthentication);

		Log.d("AuthenticationActivity", "9 Ok");
		
	}

	@Override
	public void onBackPressed()
	{

	   // super.onBackPressed(); // Comment this super call to avoid calling finish()
	}
	
	public void goAccept(View view)
	{
		Log.d("AuthenticationActivity", "goAccept 1");
		if (!InternetStatus.isOnline())
		{
			Log.d("AuthenticationActivity", "goAccept 2");
			General.alertError(this, getResources().getString(R.string.network_error), getResources().getString(R.string.check_connection));
		}
		else
		{
			Log.d("AuthenticationActivity", "goAccept 3");
			if (null != dialog) dialog.dismiss();
			Log.d("AuthenticationActivity", "goAccept 4");
			dialog = ProgressDialog.show(AuthenticationActivity.this, getResources().getString(R.string.hold_on), getResources().getString(R.string.register_go), true);
			Log.d("AuthenticationActivity", "goAccept 5");
			registerTask = new Runnable()
		    {
				public void run()
				{
					Log.d("AuthenticationActivity", "goAccept 6");
					
					Log.d("AuthenticationActivity", "goAccept 7");
					if (Synchronize.verifyAuthentication(user_email,txtCodAuthentication.getText().toString()))
					{
						Log.d("AuthenticationActivity", "goAccept 8");
						UserInfo.setStatusConf(true);
/*						UserInfo.setUserInfo(user_name, companyName,user_email);*/
						Log.d("AuthenticationActivity", "goAccept 9");
						Synchronize.sendApps();
						Log.d("AuthenticationActivity", "goAccept 10");
						Synchronize.downloadCompanySettings();
						Log.d("AuthenticationActivity", "goAccept 11");
						Synchronize.downloadAllowedApps(true);
						Log.d("AuthenticationActivity", "goAccept 12");
						Synchronize.downloadAllowedSettingsMenu();
						Log.d("AuthenticationActivity", "goAccept 13");

						dialog.dismiss();
						Intent intentLauncher = new Intent(AuthenticationActivity.this, MainActivity.class);
						startActivity(intentLauncher);
					}
					else
					{
						Log.d("AuthenticationActivity", "goAccept 9");
						dialog.dismiss();
						
						AuthenticationActivity.this.runOnUiThread(new Runnable() 
						{
							public void run() 
							{
								General.alertError(AuthenticationActivity.this, getResources().getString(R.string.error), getResources().getString(R.string.authentication_problem));
							}
						});
					}
				}
			};
			Thread appLoaderThread = new Thread(null, registerTask, "AppLoaderThread");
			appLoaderThread.start();
		}
	}
	
}
