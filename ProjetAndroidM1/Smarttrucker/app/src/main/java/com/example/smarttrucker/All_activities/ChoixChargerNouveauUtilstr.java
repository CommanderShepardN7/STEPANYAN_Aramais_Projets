package com.example.smarttrucker.All_activities;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;

import com.example.smarttrucker.OtherClasses.MyAdapterListView;
import com.example.smarttrucker.R;
import com.example.smarttrucker.OtherClasses.SaveLoadUtilisateur;
import com.example.smarttrucker.OtherClasses.Utilisateur;

import org.json.JSONException;

import java.util.List;

public class ChoixChargerNouveauUtilstr extends AppCompatActivity {

    private List<Utilisateur> listeUtilisateurs;
    private Context context;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.choix_charger_nouveau);

        final ListView listView = findViewById(R.id.listView);
        this.context = getApplicationContext();



        //On obtient la liste avec des utilisateurs.
        try {
            SaveLoadUtilisateur svLDutilisateur = new SaveLoadUtilisateur(this.context);
            this.listeUtilisateurs = svLDutilisateur.getListUtilisateursFromJsObject();
        } catch (JSONException e) {
            e.printStackTrace();
        }

        //On affiche cette liste.
        MyAdapterListView myAdapterListView = new MyAdapterListView(this,listeUtilisateurs);
        listView.setAdapter(myAdapterListView);


        //On ajoute un événement lorsque on clique sur un utilisateur.
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, final int position, long id) {

                //On crée un dialogue qui affiche l'information sur la partie sauvegardée ainsi deux boutons 'oui' 'non' pour charger.
                AlertDialog.Builder a_builder = new AlertDialog.Builder(ChoixChargerNouveauUtilstr.this);
                a_builder.setMessage("Charger : '" + listeUtilisateurs.get(position).getNom() + "' ?")
                        .setCancelable(false)
                        .setPositiveButton("Oui", new DialogInterface.OnClickListener() {
                            @Override
                            //Si on clique sur le bouton 'oui, on change l'activité et on envoie l'utilisateur sur cette nouvelle activité.
                            public void onClick(DialogInterface dialog, int which) {
                                Intent intentChoisirTrajet = new Intent(ChoixChargerNouveauUtilstr.this, ChoisirTrajet.class);//ChoisirTrajet.class
                                intentChoisirTrajet.putExtra("activity", "ChoixChargerNouveauUtilstr");
                                intentChoisirTrajet.putExtra("utilisateur", listeUtilisateurs.get(position));
                                startActivity(intentChoisirTrajet);
                            }
                        })
                        .setNegativeButton("Non", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                dialog.cancel();
                            }
                        });

                AlertDialog alert = a_builder.create();
                alert.setTitle("Charger la partie sauvegardée");
                alert.show();
            }
        });


        Button buttonStart = (Button) findViewById(R.id.nouveauUtilisateurButton);
        buttonStart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentStart = new Intent(ChoixChargerNouveauUtilstr.this, CreerUtilisateur.class);
                startActivity(intentStart);
            }
        });

        Button retour = (Button)findViewById(R.id.buttonRetour);
        retour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentGarage = new Intent(ChoixChargerNouveauUtilstr.this, MainActivity.class);
                startActivity(intentGarage);
            }
        });

    }

}
