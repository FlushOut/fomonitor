package com.flushout.fomonitor.Adapters;

import java.util.ArrayList;

import android.content.Context;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;


import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.Font;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.Models.MenuSettingsOption;
import com.flushout.fomonitor.Models.UserSettings;

public class SettingsAdapter extends BaseAdapter 
{
	private Context mContext;
	private ArrayList<MenuSettingsOption> options;
	
    public SettingsAdapter(Context context) 
    {
    	this.mContext = context;
    	this.options = UserSettings.listAllowedOptions();
    }

    @Override
    public long getItemId(int position) 
    {
    	return 0;
    }

    @Override
    public boolean hasStableIds() 
    {
      return true;
    }

	@Override
	public int getCount() 
	{
		return options.size();
	}

	@Override
	public Object getItem(int arg0) 
	{
		return null;
	}

	@Override
	public View getView(int pos, View arg1, ViewGroup arg2) 
	{
		LayoutInflater inflater = (LayoutInflater) mContext.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    	View cellView;
    
    	cellView = new View(mContext);
    	cellView = inflater.inflate(R.layout.settingslist, null);
    	
		TextView textView = (TextView) cellView.findViewById(R.id.item_label);
		textView.setText(this.options.get(pos).getTitle());
		textView.setTypeface(Font.get_font("regular"));
		
		ImageView imageView = (ImageView) cellView.findViewById(R.id.item_image);
		Drawable icon = General.getAppContext().getResources().getDrawable(this.options.get(pos).getIconRes());
		imageView.setImageDrawable(icon);
    	
    	return cellView;
	}
}
