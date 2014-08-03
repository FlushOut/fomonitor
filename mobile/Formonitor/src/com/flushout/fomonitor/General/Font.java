package com.flushout.fomonitor.General;

import android.graphics.Typeface;

public class Font 
{
	public static Typeface get_font()
	{
		Typeface font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Regular.ttf");
		return font;
	}
	
	public static Typeface get_font(String style)
	{
		Typeface font;
		
		if (style.equals("black"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Black.ttf");
		else if (style.equals("black italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-BlackItalic.ttf");
		else if (style.equals("bold"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Bold.ttf");
		else if (style.equals("bold condensed"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-BoldCondensed.ttf");
		else if (style.equals("bold condensed italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-BoldCondensedItalic.ttf");
		else if (style.equals("bold italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-BoldItalic.ttf");
		else if (style.equals("italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Italic.ttf");
		else if (style.equals("light"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Light.ttf");
		else if (style.equals("light italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-LightItalic.ttf");
		else if (style.equals("medium"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Medium.ttf");
		else if (style.equals("medium italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-MediumItalic.ttf");
		else if (style.equals("thin"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Thin.ttf");
		else if (style.equals("light italic"))
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-ThinItalic.ttf");
		else
			font = Typeface.createFromAsset(General.getAppContext().getAssets(), "fonts/Roboto-Regular.ttf");
		
		return font;
	}
}
