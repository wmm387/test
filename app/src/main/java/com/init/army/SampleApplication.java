package com.init.army;

import android.app.Application;

import com.dmmgp.game.sdk.DmmgpSdk;

public class SampleApplication extends Application{

    @Override
    public void onCreate() {
        super.onCreate();

        DmmgpSdk.initialize(this, R.xml.dmmgp_game_configuration);
    }
}
