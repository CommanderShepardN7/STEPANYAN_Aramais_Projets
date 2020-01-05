package com.example.smarttrucker.All_activities;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.smarttrucker.OtherClasses.FileHelper;
import com.example.smarttrucker.OtherClasses.Question;
import com.example.smarttrucker.R;
import com.example.smarttrucker.OtherClasses.Utilisateur;
import com.example.smarttrucker.OtherClasses.Videoplay_class;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Random;

public class StartClass extends AppCompatActivity {

    private List<Question> listeQuestions;

    private Button buttonChoix1, buttonChoix2,buttonChoix3,buttonChoix4;
    private TextView questionView;
    private Utilisateur utilisateur;

    private int points;
    private int carburant;
    private int etatCamion;

    private int nbReponseCorrect = 0;
    private int totalQuestion;

    private String reponseCorrect;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.start_page);

        //===*** Récupération des informations sur l'utilisateur. ***===//
        setInfoUtilisateur((Utilisateur) getIntent().getExtras().get("utilisateur"));

        questionView = (TextView)findViewById(R.id.questionViewId);
        buttonChoix1 = (Button)findViewById(R.id.choix1Id);
        buttonChoix2 = (Button)findViewById(R.id.choix2Id);
        buttonChoix3 = (Button)findViewById(R.id.choix3Id);
        buttonChoix4 = (Button)findViewById(R.id.choix4Id);

        //Récupération et affichage des questions
        new FileHelper(this.getApplicationContext(),null,null) {
            @Override
            public void createListResponse(List<Question> listeQuestions) {
                //** Récupération **//
                StartClass.this.listeQuestions = listeQuestions;
                StartClass.this.totalQuestion = listeQuestions.size();
                //** affichage **//
                afficheProchaineQuestion();
            }

            @Override
            public String getLevel() {
                //===*** Obtention du numero de trajet choisit dans la class ChoisirTrajet ***===//
                return getIntent().getExtras().get("trajetLevel").toString();
            }
        };
    }

    private void setInfoUtilisateur(Utilisateur utilisateur){
        this.carburant = utilisateur.getMonCamion().getCarburantActuelLitre();
        this.points = utilisateur.getPoints();
        this.etatCamion = utilisateur.getMonCamion().getEtat();
        this.utilisateur = utilisateur;
    }

    private void afficheProchaineQuestion(){
        //===*** Random. ***===//
        int randomNum = new Random().nextInt(listeQuestions.size());
        Log.d("Random ===========", "******** " + randomNum);
        Log.d("Size", "******** " + listeQuestions.size());

        //===*** Question et le reponse correct. ***===//
        questionView.setText(listeQuestions.get(randomNum).getQuestionText());
        reponseCorrect = listeQuestions.get(randomNum).getReponse1();


        //===*** Lancer la video ***===//
        if (!listeQuestions.get(randomNum).getUrlVideo().equals("null")){
            Intent intent = new Intent(this, Videoplay_class.class);
            intent.putExtra("urlVideo",listeQuestions.get(randomNum).getUrlVideo());
            startActivity(intent);
        }


        //===*** On cree un tableau et on insere les variants reponses pour pouvoir les melanger. ***===//
        ArrayList<String> variantReponcesTemp = new ArrayList<>();
        variantReponcesTemp.add(listeQuestions.get(randomNum).getReponse1());
        variantReponcesTemp.add(listeQuestions.get(randomNum).getReponse2());
        variantReponcesTemp.add(listeQuestions.get(randomNum).getReponse3());
        variantReponcesTemp.add(listeQuestions.get(randomNum).getReponse4());
        Collections.shuffle(variantReponcesTemp);

        //===*** On supprime la question quelle a du s'affichée de la liste avec toutes les questions.***===//
        listeQuestions.remove(randomNum);

        //===*** On affiche les variants. ***===//
        buttonChoix1.setText(variantReponcesTemp.get(0));
        buttonChoix2.setText(variantReponcesTemp.get(1));
        buttonChoix3.setText(variantReponcesTemp.get(2));
        buttonChoix4.setText(variantReponcesTemp.get(3));


    }

    private void miseaJourUtilisateur(){
        utilisateur.setPoints(this.points);
        utilisateur.getMonCamion().setEtat(etatCamion);
        utilisateur.getMonCamion().setCarburantActuelLitre(carburant);
    }

    public void checkReponse (View view){

        //On click sur un boutton
        Button reponseBoutton = (Button) findViewById(view.getId());
        String bouttonText = reponseBoutton.getText().toString();

        final String alertTitle;

        if (bouttonText.equals(reponseCorrect)){
            //Correcte
            alertTitle = "Correct!";
            points+=10;
            carburant-=10;
            nbReponseCorrect++;
        }else{
            //Incorecte
            alertTitle = "Incorrect!";
            carburant-= 15;
        }

        etatCamion-= 5;

        //Dialog
        final AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle(alertTitle);
        builder.setMessage("Reponse : " + reponseCorrect + "\n" +
                        "Points : " + points +             "\n" +
                        "Etat du camion : " + etatCamion+"%"+"\n"+
                        "Carburant : " + carburant +        "\n"+
                        "Réponses correctes : " + nbReponseCorrect + "/" + totalQuestion
                );

        builder.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                if (listeQuestions.size() != 0){
                    afficheProchaineQuestion();

                }else{

                    miseaJourUtilisateur();
                    Intent intent = new Intent(StartClass.this, AfficheResult.class);
                    intent.putExtra("utilisateur",utilisateur);
                    intent.putExtra("points",points);
                    intent.putExtra("carburant",carburant);
                    intent.putExtra("condition",etatCamion);
                    intent.putExtra("nbReponsesCorrectes",nbReponseCorrect);
                    intent.putExtra("nbQuestionsCorrectes",totalQuestion);
                    startActivity(intent);
                }

            }
        });

        builder.setCancelable(false);
        builder.show();

    }

}
