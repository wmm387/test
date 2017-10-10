package com.init.army;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.widget.Toast;

import com.dmmgp.game.sdk.app.DmmgpGoldActivity;
import com.dmmgp.game.sdk.app.DmmgpSplashActivity;
import com.dmmgp.game.sdk.osapi.DmmgpApi;
import com.dmmgp.game.sdk.osapi.model.DmmgpPayment;
import com.dmmgp.game.sdk.osapi.model.DmmgpPaymentItem;
import com.dmmgp.game.sdk.osapi.model.DmmgpPerson;
import com.dmmgp.game.sdk.osapi.payment.DmmgpPaymentRequest;
import com.dmmgp.game.sdk.osapi.payment.DmmgpPaymentResponse;
import com.dmmgp.game.sdk.osapi.people.DmmgpPeopleRequest;
import com.dmmgp.game.sdk.osapi.people.DmmgpPeopleResponse;
import com.dmmgp.lib.auth.activity.DmmgpLoginActivity;

public class MainMethod {

    private static final String TAG = "MainMethod";

    private static Context unityContext;
    private static Activity unityActivity;

    private static DmmgpPayment mLastPayment;

    public static void init(Context paramContext) {
        unityContext = paramContext.getApplicationContext();
        unityActivity = (Activity) paramContext;
    }

    public static void getUserInfo() throws Exception {
        DmmgpPeopleRequest req = DmmgpApi.getRequestApi().requestProfile();
        DmmgpPeopleResponse res = req.execute();

        Log.d(TAG, "Response code: " + res.getResponseCode());

        DmmgpPerson profile = res.getPersons().get(0);
        Log.d(TAG, "User Id: " + profile.getId());
        Log.d(TAG, "Display Name: " + profile.getDisplayName());
        Log.d(TAG, "Nickname: " + profile.getNickname());

        final String str = "User Id: " + profile.getId() + " Display Name: " + profile.getDisplayName()
                            + " Nickname: " + profile.getNickname();

        unityActivity.runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(unityContext, str, Toast.LENGTH_LONG).show();
            }
        });
    }

    public static void payment() throws Exception {
        DmmgpPayment payment = new DmmgpPayment();
        payment.setCallbackUrl("http://test1-sbox-verifygame.nutaku.com/payment/sp-callback");
        payment.setFinishPageUrl("http://www.nutaku.net/");
        payment.setMessage("Test Payment");

        DmmgpPaymentItem item1 = new DmmgpPaymentItem();
        item1.setItemId("1");
        item1.setItemName("Item 1");
        item1.setUnitPrice(100);
        item1.setQuantity(1);
        item1.setImageUrl("http://test1-sbox-verifygame.nutaku.com/images/item001.gif");
        item1.setDescription("Item 1 description ");
        payment.getPaymentItems().add(item1);

        DmmgpPaymentRequest req = DmmgpApi.getRequestApi().postPayment(payment);
        DmmgpPaymentResponse res = req.execute();
        if(res.isSuccess()) {
            for (DmmgpPayment payment2 : res.getPayments()) {
                mLastPayment = payment2;
//                Game.getInstance().setPayment(payment2);

                Log.d(TAG, "------------");
                Log.d(TAG, "app ID: " + payment2.getAppId());
                Log.d(TAG, "payment ID: " + payment2.getPaymentId());
//                Log.d(TAG, "status: " + Util.getPaymentStatusName(payment2.getStatus()));
                Log.d(TAG, "message: " + payment2.getMessage());
                Log.d(TAG, "order date and time: " + payment2.getOrderedTime());
                Log.d(TAG, "payment date and time: " + payment2.getExecutedTime());
                for (DmmgpPaymentItem item : payment2.getPaymentItems()) {
                    Log.d(TAG, "¥t-------------");
                    Log.d(TAG, "¥t item name: " + item.getItemName());
                    Log.d(TAG, "¥t quantity: " + item.getQuantity());
                    Log.d(TAG, "¥t unit price: " + item.getUnitPrice());
                    Log.d(TAG, "¥t description: " + item.getDescription());
                }
            }
        }
    }

    public static void login() {
        Intent intent = new Intent(unityContext, DmmgpLoginActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        unityContext.startActivity(intent);
    }

    public static void gold() {
        Intent intent = new Intent(unityContext, DmmgpGoldActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        unityContext.startActivity(intent);
    }

    public static void splash() {
        Intent intent = new Intent(unityContext, DmmgpSplashActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        unityContext.startActivity(intent);
    }

}
