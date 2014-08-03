package com.flushout.fomonitor;

import com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.General.InternetStatus;
import com.flushout.fomonitor.Models.UserInfo;
import com.flushout.fomonitor.WebService.Synchronize;
import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.Font;

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

public class ConfirmationActivity extends ActionBarActivity {

	private String activationCode;
	private String companyName;
	private String categoryId;
	Runnable registerTask = null;
	private String pin;
	
	private EditText txtUserName;
	private EditText txtUserEmail;
	ProgressDialog  dialog;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		Log.d("ConfirmationActivity", "1");
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.confirmation_activity);
		Log.d("ConfirmationActivity", "2");
		TextView txtConfirmation_1 = (TextView) findViewById(R.id.txtConfirmation_1);
		TextView txtCompanyName = (TextView) findViewById(R.id.txtCompanyName);
		TextView txtConfirmation_2 = (TextView) findViewById(R.id.txtConfirmation_2);
		Log.d("ConfirmationActivity", "3");
		
		
		Intent intent = this.getIntent();
		Log.d("ConfirmationActivity", "4");
		activationCode = intent.getStringExtra("activationCode");
		companyName = intent.getStringExtra("companyName");
		categoryId = intent.getStringExtra("categoryId");
		pin = intent.getStringExtra("pin");
		Log.d("ConfirmationActivity", "5");
		txtCompanyName.setText(companyName);
		Log.d("ConfirmationActivity", "6");
		//Wizard_Open.pin 
		Button btnNext = (Button) findViewById(R.id.btnNext);
		Log.d("ConfirmationActivity", "8");
		txtUserName = (EditText) findViewById(R.id.txtUserName);
		txtUserEmail = (EditText) findViewById(R.id.txtUserEmail);
		Log.d("ConfirmationActivity", "9 Ok");
		
	}
	
	public void goAccept(View view)
	{
		Log.d("ConfirmationActivity", "goAccept 1");
		if (!InternetStatus.isOnline())
		{
			Log.d("ConfirmationActivity", "goAccept 2");
			General.alertError(this, getResources().getString(R.string.network_error), getResources().getString(R.string.check_connection));
		}
		else
		{
			Log.d("ConfirmationActivity", "goAccept 3");
			if (null != dialog) dialog.dismiss();
			Log.d("ConfirmationActivity", "goAccept 4");
			dialog = ProgressDialog.show(ConfirmationActivity.this, getResources().getString(R.string.hold_on), getResources().getString(R.string.register_go), true);
			Log.d("ConfirmationActivity", "goAccept 5");
			registerTask = new Runnable()
		    {
				public void run()
				{
					Log.d("ConfirmationActivity", "goAccept 6");
					String user_name = txtUserName.getText().toString();
					String user_email = txtUserEmail.getText().toString();
					
					Log.d("ConfirmationActivity", "goAccept 7");
					if (Synchronize.sendRegisterUser(activationCode, user_name, pin, categoryId,user_email))
					{
						Log.d("ConfirmationActivity", "ConfirmationActivity->goAccept 8");
						UserInfo.setUserInfo(user_name, companyName,user_email,false);
/*						Log.d("ConfirmationActivity", "goAccept 9");
						Synchronize.sendApps();
						Log.d("ConfirmationActivity", "goAccept 10");
						Synchronize.downloadCompanySettings();
						Log.d("ConfirmationActivity", "goAccept 11");
						Synchronize.downloadAllowedApps(true);
						Log.d("ConfirmationActivity", "goAccept 12");
						Synchronize.downloadAllowedSettingsMenu();
						Log.d("ConfirmationActivity", "goAccept 13");

						dialog.dismiss();*/
						Intent intentLauncher = new Intent(ConfirmationActivity.this, AuthenticationActivity.class);
						intentLauncher.putExtra("user_name", user_name);
						intentLauncher.putExtra("companyName", companyName);
						intentLauncher.putExtra("user_email", user_email);
						startActivity(intentLauncher);
					}
					else
					{
						Log.d("ConfirmationActivity", "goAccept 9");
						dialog.dismiss();
						
						ConfirmationActivity.this.runOnUiThread(new Runnable() 
						{
							public void run() 
							{
								General.alertError(ConfirmationActivity.this, getResources().getString(R.string.error), getResources().getString(R.string.register_problem));
							}
						});
					}
				}
			};
			Thread appLoaderThread = new Thread(null, registerTask, "AppLoaderThread");
			appLoaderThread.start();

/*			Log.d("ConfirmationActivity", "goAccept 6");
			String user_name = txtUserName.getText().toString();
			Log.d("ConfirmationActivity", "goAccept 7");
			if (Synchronize.sendRegisterUser(activationCode, user_name, pin))
			{
				Log.d("ConfirmationActivity", "goAccept 8");
				UserInfo.setUserInfo(user_name, companyName);
				Log.d("ConfirmationActivity", "goAccept 9");
				Synchronize.sendApps();
				Log.d("ConfirmationActivity", "goAccept 10");
				Synchronize.downloadCompanySettings();
				Log.d("ConfirmationActivity", "goAccept 11");
				Synchronize.downloadAllowedApps(true);
				Log.d("ConfirmationActivity", "goAccept 12");
				Synchronize.downloadAllowedSettingsMenu();
				Log.d("ConfirmationActivity", "goAccept 13");
			
				dialog.dismiss();
				Intent intentLauncher = new Intent(ConfirmationActivity.this, MainActivity.class);
				startActivity(intentLauncher);
			} else{
				Log.d("ConfirmationActivity", "goAccept 9");
				dialog.dismiss();
				
				ConfirmationActivity.this.runOnUiThread(new Runnable() 
				{
					public void run() 
					{
						General.alertError(ConfirmationActivity.this, getResources().getString(R.string.error), getResources().getString(R.string.register_problem));
					}
				});
			}*/
		}
	}

	public void goCancel(View view)
	{
		Intent intentRegister = new Intent(this, RegisterActivity.class);
		
		startActivity(intentRegister);
	}	
	
}
