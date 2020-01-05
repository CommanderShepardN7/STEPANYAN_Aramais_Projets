package com.example.smarttrucker.All_activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.example.smarttrucker.R;

public class MainActivity extends AppCompatActivity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // ***Bouton start action** //

        final Button buttonStart = (Button) findViewById(R.id.Start);
        buttonStart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentStart = new Intent(MainActivity.this, ChoixChargerNouveauUtilstr.class);//ChoisirTrajet.class
                startActivity(intentStart);
            }
        });


        // ***Bouton editer action** //
        final Button buttonEdit = (Button) findViewById(R.id.Editer);
        buttonEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentEditer = new Intent(MainActivity.this, EditerClass.class);
                startActivity(intentEditer);
            }
        });

    }
}
