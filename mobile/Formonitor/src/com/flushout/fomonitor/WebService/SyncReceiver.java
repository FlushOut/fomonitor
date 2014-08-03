package com.flushout.fomonitor.WebService;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;

public class SyncReceiver extends BroadcastReceiver
{
	public static final String ACTION_RESP = "com.flushout.fomonitor.intent.action.MESSAGE_PROCESSED";
	
	@Override
	public void onReceive(Context context, Intent intent) 
	{
		System.out.println("DEBG: FECHOU!");
	}

}
