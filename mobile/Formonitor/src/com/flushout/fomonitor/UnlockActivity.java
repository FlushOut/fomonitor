package com.flushout.fomonitor;


import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.General.Passwords;

import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.Button;

public class UnlockActivity  extends ActionBarActivity {

	private EditText txtCodUnlock;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		Log.d("FomonitorLog", "UnlockActivity->onCreate->begin");
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.unlock_activity);

		txtCodUnlock = (EditText) findViewById(R.id.txtCodUnlock);
		Log.d("FomonitorLog", "UnlockActivity->onCreate->end");
	}

	public void unlockProcess(View view)
	{
		Log.d("FomonitorLog", "UnlockActivity->unlockProcess->begin");
		if(txtCodUnlock.getText().toString().length() == 6){
			Log.d("FomonitorLog", "UnlockActivity->unlockProcess->1");

			if (Passwords.validateUnlock(txtCodUnlock.getText().toString())){
				MainActivity.getInstance().finish();
				Log.d("FomonitorLog", "UnlockActivity->unlockProcess->2");
				finish();
				Log.d("FomonitorLog", "UnlockActivity->unlockProcess->3");
			}else{
				Log.d("FomonitorLog", "UnlockActivity->unlockProcess->4");
				General.alertError(UnlockActivity.this, getString(R.string.error), getString(R.string.invalid_password));
				Log.d("FomonitorLog", "UnlockActivity->unlockProcess->5");
				txtCodUnlock.setText("");
			}
		}
		Log.d("FomonitorLog", "UnlockActivity->unlockProcess->end");
	}
	
}
