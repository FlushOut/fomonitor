package com.flushout.fomonitor.WebService;

import android.app.IntentService;
import android.content.Intent;
import android.util.Log;

public class IntentSendApps extends IntentService 
{
	@Override
	public void onCreate() 
	{
        super.onCreate();
    }


	public IntentSendApps() 
	{
		super("IntentSendApps");
	}
	
	@Override
    public int onStartCommand(Intent intent, int flags, int startId) 
	{
        super.onStartCommand(intent, startId, startId);
        return START_STICKY;
    }

	@Override
	protected void onHandleIntent(Intent intent) 
	{
		Log.d("FomonitorLog", "IntentSendApps->onHandleIntent->begin");
		Synchronize.sendApps();
		Log.d("FomonitorLog", "IntentSendApps->onHandleIntent->1");
		Intent broadcastIntent = new Intent();
		Log.d("FomonitorLog", "IntentSendApps->onHandleIntent->2");
        broadcastIntent.setAction(SyncReceiver.ACTION_RESP);
        Log.d("FomonitorLog", "IntentSendApps->onHandleIntent->3");
        broadcastIntent.addCategory(Intent.CATEGORY_DEFAULT);
        Log.d("FomonitorLog", "IntentSendApps->onHandleIntent->4");
        sendBroadcast(broadcastIntent);
        Log.d("FomonitorLog", "IntentSendApps->onHandleIntent->5");
	}
}