package com.example.mobacc;


import android.content.Context;


public class ActivityUtile extends android.app.Application {

    private static ActivityUtile instance;

    public ActivityUtile() {
    	instance = this;
    }

    public static Context getContext() {
    	return instance;
    }

}