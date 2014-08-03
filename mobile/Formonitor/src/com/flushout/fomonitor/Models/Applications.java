package com.flushout.fomonitor.Models;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.ResolveInfo;

import com.flushout.fomonitor.General.General;

public class Applications 
{
	private ArrayList<AppInfo> packageList = null;
	private List<ResolveInfo> activityList = null;
	private Intent mainIntent = new Intent(Intent.ACTION_MAIN, null);
	private PackageManager packMan = null;
	
	public Applications(PackageManager packManager)
	{
		packMan = packManager;
		packageList = this.createPackageList(false);
		activityList = this.createActivityList();
		this.addClassNamesToPackageList();
	}
	
	public ArrayList<AppInfo> getPackageList()
	{
		return packageList;
	}
	
	public List<ResolveInfo> getActivityList()
	{
		return activityList;
	}
	
	private ArrayList<AppInfo> createPackageList(boolean getSysPackages)
	{
		ArrayList<AppInfo> pList = new ArrayList<AppInfo>();        
	    
		Context ctx = General.getAppContext();
		
	    List<PackageInfo> packs = ctx.getPackageManager().getInstalledPackages(0);
	    
	    for(int i = 0; i < packs.size(); i++)
	    {
	        PackageInfo packInfo = packs.get(i);
	        
	        if((!getSysPackages) && (packInfo.versionName == null))
	        {
	            continue ;
	        }
	        
	        AppInfo newInfo = new AppInfo();
	        
	        newInfo.appName = packInfo.applicationInfo.loadLabel(ctx.getPackageManager()).toString();
 	        newInfo.packageName = packInfo.packageName;   
	        newInfo.versionName = packInfo.versionName;
	        newInfo.versionCode = packInfo.versionCode;
	        newInfo.icon = packInfo.applicationInfo.loadIcon(ctx.getPackageManager());
	        
	        pList.add(newInfo);
	    }
	    return pList; 
	}
	
	private List<ResolveInfo> createActivityList()
	{
		List<ResolveInfo> aList = packMan.queryIntentActivities(mainIntent, 0);
		Collections.sort(aList, new ResolveInfo.DisplayNameComparator(packMan)); 
		
		return aList;
	}
	/*
	private void packageDebug()
	{
		if(null == packageList)
		{
			return;
		}
		
		for(int i = 0; i < packageList.size(); ++i){
			Log.v("PACKINFO: ", "\t" + 
					packageList.get(i).appName + "\t" + 
					packageList.get(i).packageName + "\t" + 
					packageList.get(i).className + "\t" +
					packageList.get(i).versionName + "\t" + 
					packageList.get(i).versionCode);
		}
	}
	
	private void activityDebug()
	{
		if(null == activityList)
		{
			return;
		}
		
		for(int i = 0; i < activityList.size(); i++)
		{ 
			ActivityInfo currentActivity = activityList.get(i).activityInfo;
			Log.v("ACTINFO", "pName=" + currentActivity.applicationInfo.packageName +" cName=" + currentActivity.name);
		}
	}
	*/
	private void addClassNamesToPackageList()
	{
		if(null == activityList || null == packageList)
		{
			return;
		}
		
		String tempName = "";
		
		for(int i = 0; i < packageList.size(); ++i)
		{
			tempName = packageList.get(i).packageName;
			
			for(int j = 0; j < activityList.size(); ++j)
			{
				if(tempName.equals(activityList.get(j).activityInfo.applicationInfo.packageName))
				{
					packageList.get(i).className = activityList.get(j).activityInfo.name;
				}
			}
		}
	}
}
