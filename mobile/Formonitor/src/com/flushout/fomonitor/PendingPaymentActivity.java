package com.flushout.fomonitor;

import com.flushout.fomonitor.Models.UserInfo;

import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.WindowManager;
import android.widget.TextView;

public class PendingPaymentActivity  extends ActionBarActivity {

	private TextView txvText1;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		Log.d("FomonitorLog", "MainActivity->onCreate->begin");
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.pending_payment_activity);
		Log.d("FomonitorLog", "MainActivity->onCreate->1");
		txvText1 = (TextView) findViewById(R.id.txvText1);
		Log.d("FomonitorLog", "MainActivity->onCreate->2");
		CharSequence uName = (CharSequence) " " + UserInfo.getUserName();
		Log.d("FomonitorLog", "MainActivity->onCreate->3");
		txvText1.append(uName);
		Log.d("FomonitorLog", "MainActivity->onCreate->end");
	}
	
}
