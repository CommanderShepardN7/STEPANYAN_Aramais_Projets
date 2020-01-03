package com.example.smarttrucker.All_activities;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.smarttrucker.R;
import com.example.smarttrucker.OtherClasses.Utilisateur;

public class AfficheResult extends AppCompatActivity {

    private TextView point, carburant, resultQuestion, conditionCamion;
    private Utilisateur utilisateur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.resultat);

        utilisateur = (Utilisateur)getIntent().getExtras().get("utilisateur");


        point = (TextView)findViewById(R.id.idPoints);
        carburant = (TextView)findViewById(R.id.idCarburant);
        resultQuestion = (TextView)findViewById(R.id.idQuestionResult);
        conditionCamion = (TextView)findViewById(R.id.conditionCamion);


        point.setText("Points: " + getIntent().getExtras().get("points").toString() + "$");
        carburant.setText("Carburant: " + getIntent().getExtras().get("carburant").toString() + " litres");
        resultQuestion.setText("Réponses correctes: " + getIntent().getExtras().get("nbReponsesCorrectes").toString() +
                        "/" + getIntent().getExtras().get("nbQuestionsCorrectes").toString());
        conditionCamion.setText("Etat du camion: " + getIntent().getExtras().get("condition").toString() + "%");



        Button buttonRetour = (Button) findViewById(R.id.idRetour);
        buttonRetour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentRetour = new Intent(AfficheResult.this, ChoisirTrajet.class);
                intentRetour.putExtra("activity", "AfficheResult");
                intentRetour.putExtra("utilisateur", utilisateur);
                startActivity(intentRetour);
            }
        });





    }

}
