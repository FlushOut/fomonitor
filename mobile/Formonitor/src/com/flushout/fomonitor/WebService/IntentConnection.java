package com.flushout.fomonitor.WebService;

import com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.Tracking.Tracker;

import android.app.IntentService;
import android.content.Context;
import android.content.Intent;
import android.location.LocationManager;
import android.util.Log;

public class IntentConnection extends IntentService 
{
	@Override
	public void onCreate() 
	{
        super.onCreate();
    }


	public IntentConnection() 
	{
		super("IntentConnection");
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
		Log.d("FomonitorLog", "IntentConnection->onHandleIntent->begin");
		boolean isNetworkEnabled = General.CheckInternet();
		Log.d("FomonitorLog", "IntentConnection->onHandleIntent->1 isNetworkEnabled="+isNetworkEnabled);
		if(isNetworkEnabled){
			//Synchronize.downloadUserData();
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->2");
			//Synchronize.downloadPinhash();
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->3");
			Synchronize.downloadCompanySettings();
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->4");
			Synchronize.downloadAllowedSettingsMenu();
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->5");
			Synchronize.downloadAllowedApps(false);
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->6");
			Synchronize.sendLocation();
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->7");
			Intent broadcastIntent = new Intent();
			Log.d("FomonitorLog", "IntentConnection->onHandleIntent->8");
	        broadcastIntent.setAction(SyncReceiver.ACTION_RESP);
	        Log.d("FomonitorLog", "IntentConnection->onHandleIntent->9");
	        broadcastIntent.addCategory(Intent.CATEGORY_DEFAULT);
	        Log.d("FomonitorLog", "IntentConnection->onHandleIntent->10");
	        sendBroadcast(broadcastIntent);
	        Log.d("FomonitorLog", "IntentConnection->onHandleIntent->11");
		}
        Log.d("FomonitorLog", "IntentConnection->onHandleIntent->end");
	}
	
}
