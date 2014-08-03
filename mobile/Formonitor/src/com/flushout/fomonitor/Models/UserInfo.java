package com.flushout.fomonitor.Models;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

import android.content.SharedPreferences;

import com.flushout.fomonitor.General.General;

public class UserInfo 
{
	public static String pin="";
	
	
	public static String getUserName()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		String userName = settings.getString("userName", "");
		
		return userName;
	}
	
	public static String getPark()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		String park = settings.getString("park", "");
		
		return park;
	}
	
	public static String getUserEmail()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		String email = settings.getString("userEmail", "");
		
		return email;
	}
	
	public static String getUserEmailEncode()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		String email = settings.getString("userEmail", "");
		
		try {
			email = URLEncoder.encode(email, "UTF-8");
		} catch (UnsupportedEncodingException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		return email;
	}
	
	public static Boolean getStatusConf()
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		Boolean statusConf = settings.getBoolean("statusConf", false);
		
		return statusConf;
	}
	
	public static void setStatusConf(Boolean statusConf)
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		SharedPreferences.Editor editor = settings.edit();
		editor.putBoolean("statusConf", statusConf);
		
		editor.commit();
	}
	
	public static void setUserInfo(String userName, String park, String userEmail, Boolean statusConf)
	{
		SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
		SharedPreferences.Editor editor = settings.edit();
		editor.putString("userName", userName);
		editor.putString("park", park);
		editor.putString("userEmail", userEmail);
		editor.putBoolean("statusConf", statusConf);
		
		editor.commit();	
	}
}
