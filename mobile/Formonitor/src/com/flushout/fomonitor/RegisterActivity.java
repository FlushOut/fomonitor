package com.flushout.fomonitor;

import java.util.Random;
import java.util.concurrent.ExecutionException;

import org.json.JSONException;
import org.json.JSONObject;

import com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.ConfirmationActivity;
import com.flushout.fomonitor.General.Font;
//import com.flushout.fomonitor.General.Font;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.General.InternetStatus;
import com.flushout.fomonitor.General.Passwords;
import com.flushout.fomonitor.Models.DeviceInfo;
import com.flushout.fomonitor.Models.UserInfo;
import com.flushout.fomonitor.StackTrace.ExceptionHandler;
import com.flushout.fomonitor.WebService.Synchronize;
import com.flushout.fomonitor.WebService.WSConnect;
import com.flushout.fomonitor.R;
import com.flushout.fomonitor.ConfirmationActivity;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.text.InputType;
import android.util.Log;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.os.Build;

public class RegisterActivity extends ActionBarActivity {

	public static String companyName="";
	public static String userName="";
	public static String userEmail="";
	public static String userContact="";
	public static String pin="";
	
	private EditText txtCodEmpresa;
	private TextView txvDescription;
	
	Runnable registerTask = null;
	ProgressDialog  dialog;
	String activationCode;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.register_activity);
		Log.d("RegisterActivity", "-------------------------> a");
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		txvDescription = (TextView) findViewById(R.id.txvDescription);
		Log.d("RegisterActivity", "-------------------------> b");
		txtCodEmpresa = (EditText) findViewById(R.id.txtCodEmpresa);
		Log.d("RegisterActivity", "-------------------------> c");
		Button btnProximo = (Button) findViewById(R.id.btnNext);
		Log.d("RegisterActivity", "-------------------------> d");
		txtCodEmpresa.setInputType(InputType.TYPE_TEXT_FLAG_CAP_CHARACTERS);
		Log.d("RegisterActivity", "-------------------------> e");


	}
	
	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) 
	{
		if (keyCode == KeyEvent.KEYCODE_BACK || keyCode == KeyEvent.KEYCODE_HOME) 
		{
			return true;
		}
		else 
		{
			return super.onKeyDown(keyCode, event);
		}
	}
	
	public void goLogin (View view)
	{
		Log.d("RegisterActivity", "RegisterActivity 1");
		dialog = ProgressDialog.show(RegisterActivity.this, getResources().getString(R.string.hold_on), getResources().getString(R.string.validating_activation_code), false);

		Log.d("RegisterActivity", "RegisterActivity 2");
		if (dialog.isShowing())
		{
			Log.d("RegisterActivity", "RegisterActivity 3");
			activationCode = txtCodEmpresa.getText().toString();
			Log.d("RegisterActivity", "RegisterActivity 4 -> " + activationCode);
			if (activationCode.isEmpty())
			{
				Log.d("RegisterActivity", "RegisterActivity 4.1");
				dialog.dismiss();
				General.alertError(RegisterActivity.this , getResources().getString(R.string.invalid_data), getResources().getString(R.string.type_activation_code));
			}
			else if (!InternetStatus.isOnline())
			{
				Log.d("RegisterActivity", "RegisterActivity 4.2");
				dialog.dismiss();
				General.alertError(RegisterActivity.this, getResources().getString(R.string.network_error), getResources().getString(R.string.check_connection));
			}
			else
			{
				
				registerTask = new Runnable()
			    {
					public void run()
					{
						Log.d("RegisterActivity", "RegisterActivity 5 " + activationCode);
						JSONObject returnRest = validateCode(activationCode); 
						Log.d("RegisterActivity", "RegisterActivity 6");
						if (null != returnRest)
						{
							
							try 
							{
								Log.d("RegisterActivity", "RegisterActivity->7"+ returnRest.getBoolean("status"));
								if (returnRest.getBoolean("status"))
								{
									Log.d("FomonitorLog", "RegisterActivity->goLogin->7");
									String pin;
									Log.d("FomonitorLog", "RegisterActivity->goLogin->getRandomPin()->"+getRandomPin());
									//Log.d("FomonitorLog", "RegisterActivity->goLogin->getUserPin()->"+getUserPin());
/*									if (null==getUserPin())
										pin = getRandomPin();
									else
										pin = getUserPin();*/
									pin = getRandomPin();
									
									Log.d("RegisterActivity", "8");		
									String companyName = returnRest.getString("company");
									String categoryId = returnRest.getString("categoryId");
		/*							String user_name = returnRest.getString("user_name");
									String user_email = returnRest.getString("user_email");
									String user_contact = returnRest.getString("user_contact");*/

									dialog.dismiss();
									
									Intent intentConfirmation = new Intent(RegisterActivity.this, ConfirmationActivity.class);
									
		/*							if ("null".equals(user_name)) user_name  = getRandomName();*/
									
									intentConfirmation.putExtra("pin", pin);
									intentConfirmation.putExtra("companyName", companyName);
									intentConfirmation.putExtra("categoryId", categoryId);
		/*							intentConfirmation.putExtra("user_name", user_name);
									intentConfirmation.putExtra("user_email", user_email);
									intentConfirmation.putExtra("user_contact", user_contact);*/
									intentConfirmation.putExtra("activationCode", txtCodEmpresa.getText().toString());
									Log.d("RegisterActivity", "9");
									startActivity(intentConfirmation);
								}
								else
								{
									dialog.dismiss();
									General.alertError(RegisterActivity.this, getResources().getString(R.string.error), getResources().getString(R.string.invalid_activation_code));
								}
							} 
							catch (JSONException e) 
							{
								e.printStackTrace();
							}
						}
						else
						{
							dialog.dismiss();
							General.alertError(RegisterActivity.this, getResources().getString(R.string.error), getResources().getString(R.string.communication_problem));
						}
					}
			    };
				Thread appLoaderThread = new Thread(null, registerTask, "AppLoaderThread");
				appLoaderThread.start();
			}
		}
	}
	
	public JSONObject validateCode(String code)
	{
		String url = WSConnect.SERVER+"validate/code/"+code;
		Log.d("RegisterActivity", "5.1 -> " + WSConnect.SERVER+"validate/code/"+code);
		WSConnect wsc = new WSConnect();
		Log.d("RegisterActivity", "5.2");
		wsc.execute(url);
		Log.d("RegisterActivity", "5.3");
		try 
		{
			Log.d("RegisterActivity", "5.4");
			return wsc.get();
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		
		return null;
	}

	private String getRandomName()
	{
		int nextID = Synchronize.downloadLastUserID() + 1;
		return "user"+nextID;
	}
	
	private String getUserPin()
	{
		String pinhashDownload = Synchronize.downloadPinhash();
		
		if (pinhashDownload.isEmpty() || "null".equals(pinhashDownload) || null == pinhashDownload)
			return null;
		else
			return Passwords.getPin(Synchronize.downloadPinhash(), DeviceInfo.getIMEI());
	}
	
	private String getRandomPin()
	{
		Random randomGenerator = new Random();
		int randomInt1 = randomGenerator.nextInt(10);
		int randomInt2 = randomGenerator.nextInt(10);
		int randomInt3 = randomGenerator.nextInt(10);
		int randomInt4 = randomGenerator.nextInt(10);
		
		return ""+randomInt1+randomInt2+randomInt3+randomInt4;
	}
	
	@Override
	public void onResume()
	{
		super.onResume();
		General.currentInstance = this;
	}
}
