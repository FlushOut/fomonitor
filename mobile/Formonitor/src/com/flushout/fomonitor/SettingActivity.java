package com.flushout.fomonitor;

import com.flushout.fomonitor.R;
import com.flushout.fomonitor.Adapters.SettingsAdapter;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.Models.UserSettings;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ListView;

public class SettingActivity extends Activity {
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
        // Hide title bar Notification
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.setting_activity);
		Log.d("SettingActivity", "SettingActivity-onCreate 1");
		final ListView listview = (ListView) findViewById(R.id.lvSettings);
/*		listview.setBackgroundColor(Color.BLACK);
		listview.setCacheColorHint(Color.BLACK);*/
		Log.d("SettingActivity", "SettingActivity-onCreate 2");
		SettingsAdapter ad = new SettingsAdapter(this);
		Log.d("SettingActivity", "SettingActivity-onCreate 3");
		listview.setAdapter(ad);
		Log.d("SettingActivity", "SettingActivity-onCreate 4");
	    listview.setOnItemClickListener(new AdapterView.OnItemClickListener() 
	    {
	    	@Override
	    	public void onItemClick(AdapterView<?> parent, final View view, int position, long id) 
	    	{
	    		Log.d("SettingActivity", "SettingActivity-onCreate 5");
	    		String it = UserSettings.listAllowedOptions().get(position).getPackageName();
	    		Log.d("SettingActivity", "SettingActivity-onCreate 6");	
	    		Intent intent = new Intent(it);
	    		intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
	    		intent.addFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
	    		intent.addFlags(Intent.FLAG_ACTIVITY_EXCLUDE_FROM_RECENTS);
	    		Log.d("SettingActivity", "SettingActivity-onCreate 7");
	    		startActivity(intent);
	    	}
	    });
	}
	
	@Override
	public void onResume()
	{
		super.onResume();
		General.currentInstance = this;
	}
}
