package com.flushout.fomonitor.Models;

import android.graphics.drawable.Drawable;

public class AppInfo
{
	public String appName = "";
	public String packageName = "";
	public String className = "";
	public String versionName = "";
	public Integer versionCode = 0;
	public Drawable icon = null;
	
	public String getAppName()
	{
		return appName;
	}
	
	public String getPackageName()
	{
		return packageName;
	}
	
	public String getClassName()
	{
		return className;
	}
	
	public String getVersionName()
	{
		return versionName;
	}
	
	public Integer getVersionCode()
	{
		return versionCode;
	}
	
	public Drawable getIcon()
	{
		return icon;
	}
}