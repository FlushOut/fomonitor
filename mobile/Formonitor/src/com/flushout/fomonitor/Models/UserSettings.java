package com.flushout.fomonitor.Models;

import java.util.ArrayList;

import org.json.JSONException;
import org.json.JSONObject;

import android.content.Context;
import android.content.SharedPreferences;
import android.provider.Settings;
import android.util.Log;

import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.General;

public class UserSettings 
{
	public static void updateSettings(JSONObject result)
	{	
		Log.d("UserSettings", "updateSettings 1");
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		SharedPreferences.Editor editor = settings.edit();
		
		try 
		{
			Log.d("UserSettings", "updateSettings 2");			
			editor.putBoolean("wifi", General.int2bool(result.getInt("wifi")));
			editor.putBoolean("screen", General.int2bool(result.getInt("screen")));
			editor.putBoolean("local_safety", General.int2bool(result.getInt("localsafety")));
			editor.putBoolean("apps", General.int2bool(result.getInt("apps")));
			editor.putBoolean("accounts", General.int2bool(result.getInt("accounts")));
			editor.putBoolean("privacy", General.int2bool(result.getInt("privacy")));
			editor.putBoolean("storage", General.int2bool(result.getInt("storage")));
			editor.putBoolean("keyboard", General.int2bool(result.getInt("keyboard")));
			editor.putBoolean("voice", General.int2bool(result.getInt("voice")));
			editor.putBoolean("accessibility", General.int2bool(result.getInt("accessibility")));
			editor.putBoolean("datetime", General.int2bool(result.getInt("datetime")));
			editor.putBoolean("about", General.int2bool(result.getInt("about")));
			Log.d("UserSettings", "updateSettings 3");
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
		
		editor.commit();
	}
	
	public static ArrayList<MenuSettingsOption> listAllowedOptions()
	{
		ArrayList<MenuSettingsOption> list = new ArrayList<MenuSettingsOption>();

		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		
		if (settings.getBoolean("wifi", true))
			list.add(new MenuSettingsOption(General.getAppContext().getString(R.string.settingsWifi),
					Settings.ACTION_WIRELESS_SETTINGS, R.drawable.ic_wifi));
		if (settings.getBoolean("screen", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsScreen),
					Settings.ACTION_DISPLAY_SETTINGS, R.drawable.ic_screen));
		if (settings.getBoolean("local_safety", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsLocalSafety),
					Settings.ACTION_LOCATION_SOURCE_SETTINGS,
					R.drawable.ic_location));
		System.out.println("AAA "+settings.getBoolean("apps", true));
		System.out.println("AAA "+settings.getBoolean("apps", false));
		
		if (settings.getBoolean("apps", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsApps),
					Settings.ACTION_APPLICATION_SETTINGS,
					R.drawable.ic_apps));
		if (settings.getBoolean("accounts", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsAccounts),
					Settings.ACTION_SYNC_SETTINGS, R.drawable.ic_sync));
		if (settings.getBoolean("privacy", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsPrivacy),
					Settings.ACTION_PRIVACY_SETTINGS, R.drawable.ic_privacy));
		if (settings.getBoolean("storage", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsStorage),
					Settings.ACTION_MEMORY_CARD_SETTINGS,
					R.drawable.ic_storage));
		if (settings.getBoolean("keyboard", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsKeyboard),
					Settings.ACTION_INPUT_METHOD_SETTINGS,
					R.drawable.ic_language));
		if (settings.getBoolean("accessibility", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsAccessibility),
					Settings.ACTION_ACCESSIBILITY_SETTINGS,
					R.drawable.ic_accessibility));
		if (settings.getBoolean("datetime", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsDateTime),
					Settings.ACTION_DATE_SETTINGS, R.drawable.ic_datetime));
		if (settings.getBoolean("about", true))
			list.add(new MenuSettingsOption(General.getAppContext()
					.getString(R.string.settingsAbout),
					Settings.ACTION_DEVICE_INFO_SETTINGS,
					R.drawable.ic_about));
		
		return list;
	}
	
	
	/*
	 * GPS SETTINGS
	 */
	public static void setGPS()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		SharedPreferences.Editor editor = settings.edit();
		
		editor.putInt("interval", 2000);
		editor.putInt("distance", 2);
		
		editor.commit();
	}
	
	
	public static int getGPSInterval()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		return settings.getInt("interval", 0);
	}
	
	public static int getGPSDistance()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		return settings.getInt("distance", 0);
	}
	
	/*
	 * USER SETTINGS
	 */
	
	public static void setUserData()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		SharedPreferences.Editor editor = settings.edit();
		
		editor.putString("pin", "4567");
		editor.commit();
	}
	
	public static String getUserPin()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", Context.MODE_PRIVATE);
		return settings.getString("pin", "");
	}
}
