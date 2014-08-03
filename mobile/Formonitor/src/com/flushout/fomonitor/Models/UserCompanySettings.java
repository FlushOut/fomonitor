package com.flushout.fomonitor.Models;

import android.content.Context;
import android.content.SharedPreferences;
import android.util.Log;

import com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.General.General;

public class UserCompanySettings 
{
	private SharedPreferences prefs;
	public int gps_time = 1;
	public int gps_distance = 1;
	public int statusPayment = 0;
	
	private static UserCompanySettings instance = null;

	public static UserCompanySettings get_instance()
	{
		Log.d("FomonitorLog", "UserCompanySettings->get_instance->instance->begin");
		instance = new UserCompanySettings();
		Log.d("FomonitorLog", "UserCompanySettings->get_instance->instance->end");
		return instance;
	}
	
	public static int getStatusPayment()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		int statusPayment = settings.getInt("statusPayment", 0);
		
		return statusPayment;
	}
	
	private UserCompanySettings()
	{
		prefs = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		this.gps_time = prefs.getInt("gps_time", 1);
		this.gps_distance = prefs.getInt("gps_distance", 1);
		this.statusPayment = prefs.getInt("statusPayment", 0);
	}
	
	public static void updateSettings(int gpstime, int gpsdistance, int statusPayment)
	{
		Log.d("FomonitorLog", "UserCompanySettings->updateSettings->begin");

		SharedPreferences.Editor editor = UserCompanySettings.get_instance().prefs.edit();
		editor.putInt("gps_time", gpstime);
		editor.putInt("gps_distance", gpsdistance);
		editor.putInt("statusPayment", statusPayment);
		editor.commit();
		Log.d("FomonitorLog", "UserCompanySettings->updateSettings->statusPayment->"+statusPayment);
		if(statusPayment == 0){
			//MainActivity.getInstance().finish();
			Log.d("FomonitorLog", "UserCompanySettings->updateSettings->0");
			MainActivity mainActivity = new MainActivity();
			Log.d("FomonitorLog", "UserCompanySettings->updateSettings->1");
			mainActivity.getInstance().finish();
			Log.d("FomonitorLog", "UserCompanySettings->updateSettings->2");
			mainActivity.finish();
			Log.d("FomonitorLog", "UserCompanySettings->updateSettings->3");
		}
	}
}
