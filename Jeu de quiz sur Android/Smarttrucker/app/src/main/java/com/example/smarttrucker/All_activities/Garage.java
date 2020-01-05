package com.example.smarttrucker.All_activities;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.smarttrucker.R;
import com.example.smarttrucker.OtherClasses.Utilisateur;

public class Garage extends AppCompatActivity {

    private Button reparer, carburant, achatLicence, retourSave;
    private TextView nameJView, pointJView, licenceJView, nameCamionView, carburantCamionView, etatCamionView;
    private Utilisateur utilisateur;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.garage);

        this.utilisateur = (Utilisateur)getIntent().getExtras().get("utilisateur");

        nameJView = (TextView)findViewById(R.id.textViewNameG);
        pointJView = (TextView)findViewById(R.id.textViewPointsG);
        licenceJView = (TextView)findViewById(R.id.textViewLicenceG);

        nameCamionView = (TextView)findViewById(R.id.textViewNameC);
        carburantCamionView = (TextView)findViewById(R.id.textViewCarburantC);
        etatCamionView = (TextView)findViewById(R.id.textViewEtatC);

        reparer = (Button)findViewById(R.id.buttonReparer);
        carburant = (Button)findViewById(R.id.buttonCarburant);
        achatLicence = (Button)findViewById(R.id.buttonAcheter_licence);


        setInfo();

        final Button retourSave = (Button)findViewById(R.id.buttonRetourSave);
        retourSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentretourSave = new Intent(Garage.this, ChoisirTrajet.class);
                intentretourSave.putExtra("activity", "Garage");
                intentretourSave.putExtra("utilisateur", utilisateur);
                startActivity(intentretourSave);
            }
        });
    }

    private void setInfo(){
        nameJView.setText("Nom : "  + utilisateur.getNom());
        pointJView.setText("Points : "  + Integer.toString(utilisateur.getPoints()) + "$");
        licenceJView.setText("Licence : "  + Integer.toString(utilisateur.getLevel()));

        nameCamionView.setText("Nom : "  +utilisateur.getMonCamion().getNom());
        carburantCamionView.setText("Carburant : "  + Integer.toString(utilisateur.getMonCamion().getCarburantActuelLitre()) + " litres");
        etatCamionView.setText("Etat : "  + Integer.toString(utilisateur.getMonCamion().getEtat()) + "%");
    }

    public void clickLicence(View v){
        int prixLicence = 50;
        String messageToast;

        if(checkArgent(prixLicence)) {
            utilisateur.setLevel(utilisateur.getLevel() + 1);
            acheter(prixLicence);
            messageToast = "Felicitaions! Vous avez nouvelle licence.";
        }else
            messageToast = "Pas assez d'argent!";

        setInfo();
        messageAction(messageToast);
    }

    public void clickCarburant(View v){
        int prixCarburant = 20;
        String messageToast;

        if(checkArgent(prixCarburant)){
            utilisateur.getMonCamion().setCarburantActuelLitre(utilisateur.getMonCamion().getReservoirMaxLitre());
            acheter(prixCarburant);
            messageToast = "Felicitaions! Votre réservoir est plein.";
        }else
            messageToast = "Pas assez d'argent! ";

        setInfo();
        messageAction(messageToast);
    }

    public void clickReparer(View v){
        int prixReparation = 30;
        String messageToast;

        if(checkArgent(prixReparation)){
            utilisateur.getMonCamion().setEtat(100);
            acheter(prixReparation);
            messageToast = "Felicitaions! Votre camion est reparé.";
        }else
            messageToast = "Pas assez d'argent!";

        setInfo();
        messageAction(messageToast);
    }

    private boolean checkArgent(int prix){
        return utilisateur.getPoints() >= prix;
    }

    private void acheter(int prix){
        utilisateur.setPoints(utilisateur.getPoints() - prix);
    }

    private void messageAction(CharSequence text){
        Context context = getApplicationContext();
        int duration = Toast.LENGTH_LONG;

        Toast toast = Toast.makeText(context, text, duration);
        toast.show();

    }


}
