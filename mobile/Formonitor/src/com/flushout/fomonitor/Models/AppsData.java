package com.flushout.fomonitor.Models;

public class AppsData 
{
	public int _id;
	public String packageName;
	
	public AppsData(int _id, String packageName)
	{
		this._id = _id;
		this.packageName = packageName;
	}
	
	public AppsData(String packageName)
	{
		this.packageName = packageName;
	}
}
