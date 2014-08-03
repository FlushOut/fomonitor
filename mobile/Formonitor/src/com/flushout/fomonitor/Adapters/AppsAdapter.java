package com.flushout.fomonitor.Adapters;

import java.util.ArrayList;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.Font;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.Models.AppInfo;

public class AppsAdapter extends ArrayAdapter<AppInfo>
{
	private ArrayList<AppInfo> items;
	
	public AppsAdapter(Context context, int textViewResourceId, ArrayList<AppInfo> items)
	{
        super(context, textViewResourceId, items);
        this.items = items;
	}

	@Override
    public View getView(int position, View convertView, ViewGroup parent)
	{
		View view = convertView;
		
		if(view == null)
		{
			LayoutInflater layout = (LayoutInflater)General.getAppContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
			view = layout.inflate(R.layout.applist, null);
		}
		
		AppInfo appInfo = items.get(position);
		
		if(appInfo != null)
		{
			TextView appName = (TextView) view.findViewById(R.id.grid_item_label);
			ImageView appIcon = (ImageView) view.findViewById(R.id.grid_item_image);
			
			if(appName != null)
			{
				appName.setText(appInfo.getAppName());
				appName.setTypeface(Font.get_font("regular"));
			}
			
			if(appIcon != null)
			{
				appIcon.setImageDrawable(appInfo.getIcon());
			}
		}
		
		return view;
	}

}