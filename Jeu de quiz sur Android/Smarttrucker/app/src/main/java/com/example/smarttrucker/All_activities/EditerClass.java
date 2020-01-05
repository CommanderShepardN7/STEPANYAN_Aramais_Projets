package com.example.smarttrucker.All_activities;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.smarttrucker.OtherClasses.FileHelper;
import com.example.smarttrucker.OtherClasses.Question;
import com.example.smarttrucker.R;

import java.util.List;


public class EditerClass extends AppCompatActivity {

    private EditText questionText, reponse1, reponse2, reponse3, reponse4;
    private RadioGroup choixLevel;
    private String level;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.editer_page);

        questionText = (EditText) findViewById(R.id.idQuestion);
        reponse1 = (EditText) findViewById(R.id.idreponse);
        reponse2 = (EditText) findViewById(R.id.idreponse2);
        reponse3 = (EditText) findViewById(R.id.idreponse3);
        reponse4 = (EditText) findViewById(R.id.idreponse3);
        choixLevel = (RadioGroup)findViewById(R.id.radioGroup);

        // Lorsqu'on choisit un niveau.
        this.choixLevel.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                doOnSetLevel(group, checkedId);
            }
        });

        Button saveButton= (Button) findViewById(R.id.buttonSave);
        saveButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                addQuestion();
            }
        });


        Button retour = (Button) findViewById(R.id.idRetour);
        retour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intentMain = new Intent(EditerClass.this, MainActivity.class);
                startActivity(intentMain);
            }
        });

    }

    /** La méthode addQuestion() récupère les informations saisie par l'utilisateur et
     * les envoie dans la classe FileHelper pour les stocker dans un fichier Json.*/
    private void addQuestion(){

        if(choixLevel.getCheckedRadioButtonId() == -1){
            afficheToast("Il faut choisir un trajet !");

        }else{
            Question myNewQuestion = new Question(
                    questionText.getText().toString(),
                    reponse1.getText().toString(),
                    reponse2.getText().toString(),
                    reponse3.getText().toString(),
                    reponse4.getText().toString()
            );

           new FileHelper(this.getApplicationContext(), this.level, myNewQuestion) {
                @Override
                public void createListResponse(List<Question> listeQuestions) {

                }
                @Override
                public String getLevel() {
                    return null;
                }
            };
            afficheToast("Votre question a été ajoutée");

        }
    }

    /** La méthode doOnSetLevel() récupère le trajet saisi par l'utilisateur.*/
    private void doOnSetLevel(RadioGroup group, int checkedId) {
        int checkedRadioId = group.getCheckedRadioButtonId();

        if(checkedRadioId== R.id.radioButtonLevel1) {
            this.level = "level1";
        } else if(checkedRadioId== R.id.radioButtonLevel2 ) {
            this.level = "level2";
        } else if(checkedRadioId== R.id.radioButtonLevel3) {
            this.level = "level3";
        }
    }


    private void afficheToast(String text){
        Context context = getApplicationContext();
        int duration = Toast.LENGTH_LONG;
        Toast toast = Toast.makeText(context,text, duration);
        toast.show();
    }

}
