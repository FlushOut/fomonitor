package com.flushout.fomonitor;

import android.app.Activity;
import android.os.Bundle;
import android.util.Log;
import android.view.WindowManager;
import android.widget.TextView;

import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.Models.DeviceInfo;
import com.flushout.fomonitor.Models.UserInfo;

public class UserActivity extends Activity{
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.user_activity);
		Log.d("UserActivity", "onCreate 1");	
		TextView lblEmail = (TextView)findViewById(R.id.lblEmail);
		TextView lblUser = (TextView)findViewById(R.id.lblUser);
		TextView lblPark = (TextView)findViewById(R.id.lblPark);
		Log.d("UserActivity", "onCreate 2");
		lblEmail.setText(UserInfo.getUserEmail());
		lblUser.setText(UserInfo.getUserName());
		lblPark.setText(UserInfo.getPark());
		Log.d("UserActivity", "onCreate 3");
	}
	
	@Override
	public void onResume()
	{
		super.onResume();
		General.currentInstance = this;
	}
}
