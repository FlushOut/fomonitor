package com.flushout.fomonitor.General;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;

public class RequestPassword extends BroadcastReceiver 
{
	@Override
	public void onReceive(Context context, Intent intent) 
	{
		if (intent.getAction().equals(Intent.ACTION_SCREEN_OFF)) 
		{
			System.out.println("login off");
		}
		else if (intent.getAction().equals(Intent.ACTION_SCREEN_ON)) 
		{
			System.out.println("login on");
			
			//Intent passwordAtv = new Intent(MainActivity.getInstance(), PasswordActivity.class);
			//MainActivity.getInstance().startActivity(passwordAtv);
		}
	}

}
