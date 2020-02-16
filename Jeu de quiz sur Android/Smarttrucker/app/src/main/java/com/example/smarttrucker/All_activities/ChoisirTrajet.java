package com.example.smarttrucker.All_activities;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.smarttrucker.R;
import com.example.smarttrucker.OtherClasses.SaveLoadUtilisateur;
import com.example.smarttrucker.OtherClasses.Utilisateur;

import org.json.JSONException;

public class ChoisirTrajet extends AppCompatActivity {

    private Utilisateur utilisateur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.choisir_trajet_page);


        //On récupère l'information nécessaire de l'activité précédente.
        String nomActivityPrecedent = (String) getIntent().getExtras().get("activity");
        this.utilisateur = (Utilisateur) getIntent().getExtras().get("utilisateur");

        //On sauvegarde ou on met à jour notre utilisateur.
        if (!nomActivityPrecedent.equals("ChoixChargerNouveauUtilstr")) {
            try {
                new SaveLoadUtilisateur(utilisateur, this);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        Button garage = (Button) findViewById(R.id.buttonGarage);
        garage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentGarage = new Intent(ChoisirTrajet.this, Garage.class);
                intentGarage.putExtra("utilisateur", utilisateur);
                startActivity(intentGarage);
            }
        });

        Button retour = (Button) findViewById(R.id.buttonRetour);
        retour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentGarage = new Intent(ChoisirTrajet.this, ChoixChargerNouveauUtilstr.class);
                startActivity(intentGarage);
            }
        });
    }

    public void choisirTrajet(View view) {
        String trajetLevel = null;
        String text;

        switch (view.getId()) {
            case R.id.idtrajet_1:
                trajetLevel = "level1";
                break;
            case R.id.idtrajet_2:
                trajetLevel = "level2";
                break;

            case R.id.idtrajet_3:
                trajetLevel = "level3";
                break;

            default:
                break;
        }

        if (verifierCarburant()) {
            if (verifierLicence(trajetLevel)) {
                Intent intent = new Intent(this, StartClass.class);
                intent.putExtra("trajetLevel", trajetLevel);
                intent.putExtra("utilisateur", this.utilisateur);
                startActivity(intent);
            } else{
                text = "Vous devez avoir la licence ";
                messageAction(text, trajetLevel);
            }

        }else {
            text = "Vous n'avez pas assez de carburant pour commencer le trajet ";
            messageAction(text,trajetLevel);
        }

    }

    /**La méthode verifierLicence() teste si la licence de chauffeur est égale ou supérieure de la licence nécessaire pour le trajet.**/
    private  boolean verifierLicence(String trajetLevel) {
        int level =  Integer.parseInt((trajetLevel.split("level")[1]));

        return utilisateur.getLevel() >= level;
    }

    /**La méthode verifierCarburant() teste si le niveau du carburant est égale ou supérieure de la moitié du réservoir.**/
    private  boolean verifierCarburant(){
        return (utilisateur.getMonCamion().getCarburantActuelLitre() >= utilisateur.getMonCamion().getReservoirMaxLitre() / 2) ;
    }

    private void messageAction(String text, String trajetLevel){
        String level =  (trajetLevel.split("level")[1]);
        Context context = getApplicationContext();
        int duration = Toast.LENGTH_LONG;
        Toast toast = Toast.makeText(context, text + level + " !", duration);
        toast.show();
    }




}
