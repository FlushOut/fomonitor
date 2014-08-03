package com.flushout.fomonitor.Models;

public class MenuSettingsOption 
{
	private String optionTitle;
	private String optionPackageName;
	private int optionIconRes;
	
	public MenuSettingsOption(String title, String packageName, int iconRes)
	{
		this.optionTitle = title;
		this.optionPackageName = packageName;
		this.optionIconRes = iconRes;
	}
	
	public String getTitle()
	{
		return this.optionTitle;
	}
	
	public String getPackageName()
	{
		return this.optionPackageName;
	}
	
	public int getIconRes()
	{
		return this.optionIconRes;
	}
}