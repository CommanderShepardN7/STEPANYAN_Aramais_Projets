package com.example.smarttrucker.All_activities;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import androidx.appcompat.app.AppCompatActivity;

import com.example.smarttrucker.OtherClasses.Camion;
import com.example.smarttrucker.R;
import com.example.smarttrucker.OtherClasses.Utilisateur;

public class CreerUtilisateur extends AppCompatActivity {

    private String nomCamion = "Volvo";
    private int reservoirCamion = 100;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.creer_nouv_utilistr);


        final Button buttonStart = (Button) findViewById(R.id.idSaveBoutton);
        buttonStart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentChoisirTrajet = new Intent(CreerUtilisateur.this, ChoisirTrajet.class);//ChoisirTrajet.class
                Utilisateur nouveauUtilisateur = nouveauUtilisateur();
                intentChoisirTrajet.putExtra("activity", "CreerUtilisateur");
                intentChoisirTrajet.putExtra("utilisateur", nouveauUtilisateur);
                startActivity(intentChoisirTrajet);
            }
        });
    }

    private Utilisateur nouveauUtilisateur(){
        EditText nomUtilisateur;
        nomUtilisateur = (EditText)findViewById(R.id.nomUtilisateur);

        return new Utilisateur(nomUtilisateur.getText().toString(),new Camion(nomCamion, reservoirCamion));
    }
}
