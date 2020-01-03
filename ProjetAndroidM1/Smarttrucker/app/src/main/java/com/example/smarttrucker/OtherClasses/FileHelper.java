package com.example.smarttrucker.OtherClasses;

import android.content.Context;
import android.util.Log;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.util.ArrayList;
import java.util.List;

public abstract class FileHelper {

    private static final String ip = "192.168.0.31"; //Adresse ip publique (pas local)
    private static final String cheminVersPagePHP = "/smartTruckerPHP/smartTrucker.php";

    private static String FILE_NAME = "dataQuestions.json"; // Nom du fichier avec les questions.
    private Context context;
    private JSONObject firstJsObj;
    private RequestQueue mQueue;
    private Question newQuestion;
    private String levelOfQuestion;


    public FileHelper(Context context, String level, Question myNewQuestion) {
        this.context = context;
        this.newQuestion = myNewQuestion;
        this.levelOfQuestion = level;
        read();
    }

    public void setFirstJsObj(JSONObject firstJsObj) {
        this.firstJsObj = firstJsObj;
    }

    /*** La méthode read() récupère les données du fichier json s'il existe, appel a la méthode jsonParse(). ***/
    private void read(){
        try {
            FileInputStream inFile = context.openFileInput(FILE_NAME);
            if (inFile != null) {
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inFile));
                String temp;
                StringBuilder builder = new StringBuilder();
                while ( (temp = bufferedReader.readLine()) != null) {
                    builder.append(temp);
                }
                inFile.close();
                firstJsObj = new JSONObject(builder.toString()); //===*** Met à  jour l'attribut json selon le contenu du fichier  ***===//
                ajouterQuestion(newQuestion);
                createListResponse(obtListAvecQuestionsDeJsObj(getLevel()));
            }
        } catch (FileNotFoundException e) { //===*** Si le fichier n'existe pas on le crée avec les données  ***===//
            jsonParse();
        } catch (IOException ioException) {
            ioException.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    /*** La méthode jsonParse() récupère les données du serveur si la connexion est établie sinon appel a la methode createList(). ***/
    public void jsonParse() {

        String url = "http:/" + ip + cheminVersPagePHP;
        mQueue = Volley.newRequestQueue(context.getApplicationContext());

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            //Connexion server OK
            @Override
            public void onResponse(JSONObject response) {
                setFirstJsObj(response);
                ajouterQuestion(newQuestion);
                createListResponse(obtListAvecQuestionsDeJsObj(getLevel()));

            }
        }, new Response.ErrorListener() {
            //Connexion server non OK
            @Override
            public void onErrorResponse(VolleyError error) {
                createList();
                ajouterQuestion(newQuestion);
                createListResponse(obtListAvecQuestionsDeJsObj(getLevel()));

                error.printStackTrace();
            }
        });


        mQueue.add(request);
    }

    /*** La méthode createList() crée les questions en local s'il n'y a pas de connexion avec le serveur. */
    private void createList(){

        try {

            //===*** Tableaux des levels ***===//
            JSONArray jsALevel1 = new JSONArray();
            JSONArray jsALevel2 = new JSONArray();
            JSONArray jsALevel3 = new JSONArray();

            //===***Init des objets pour les questions de niveaux L1 L2 L3 ***===//
            JSONObject js1L1 = new JSONObject();
            JSONObject js2L1 = new JSONObject();
            JSONObject js3L1 = new JSONObject();
            JSONObject js4L1 = new JSONObject();

            JSONObject js1L2 = new JSONObject();
            JSONObject js2L2 = new JSONObject();
            JSONObject js3L2 = new JSONObject();

            JSONObject js1L3 = new JSONObject();
            JSONObject js2L3 = new JSONObject();
            JSONObject js3L3 = new JSONObject();

            //===**** Level 1 ***===//
            js1L1.put("questionText", "La capitale de la Russie (Local)");
            js1L1.put("urlVideo", "null");
            js1L1.put("reponse1", "Moscow");
            js1L1.put("reponse2", "Paris");
            js1L1.put("reponse3", "Madrid");
            js1L1.put("reponse4", "Kaliningrad");

            js2L1.put("questionText", "La capitale d'Italie (Local)");
            js2L1.put("urlVideo", "null");
            js2L1.put("reponse1", "Rome");
            js2L1.put("reponse2", "Berlin");
            js2L1.put("reponse3", "Kiev");
            js2L1.put("reponse4", "Kabul");

            js3L1.put("questionText", "La capitale d'Espagne (Local)");
            js3L1.put("urlVideo", "null");
            js3L1.put("reponse1", "Madrid");
            js3L1.put("reponse2", "Berlin");
            js3L1.put("reponse3", "Kiev");
            js3L1.put("reponse4", "Kabul");

            js4L1.put("questionText", "Quelle ville est-ce (Local)");
            js4L1.put("urlVideo", "fT4lDU-QLUY");
            js4L1.put("reponse1", "New York");
            js4L1.put("reponse2", "London");
            js4L1.put("reponse3", "Chicago");
            js4L1.put("reponse4", "Ottawa");

            //===**** Level 2 ***===//
            js1L2.put("questionText", "La capitale de la Russie (Local L2)");
            js1L2.put("urlVideo", "null");
            js1L2.put("reponse1", "Moscow");
            js1L2.put("reponse2", "Paris");
            js1L2.put("reponse3", "Madrid");
            js1L2.put("reponse4", "Kaliningrad");

            js2L2.put("questionText", "La capitale d'Italie (Local L2)");
            js2L2.put("urlVideo", "null");
            js2L2.put("reponse1", "Rome");
            js2L2.put("reponse2", "Berlin");
            js2L2.put("reponse3", "Kiev");
            js2L2.put("reponse4", "Kabul");

            js3L2.put("questionText", "La capitale d'Espagne (Local L2)");
            js3L2.put("urlVideo", "null");
            js3L2.put("reponse1", "Madrid");
            js3L2.put("reponse2", "Berlin");
            js3L2.put("reponse3", "Kiev");
            js3L2.put("reponse4", "Kabul");

            //===**** Level 3 ***===//
            js1L3.put("questionText", "La capitale de la Russie (Local L3)");
            js1L3.put("urlVideo", "null");
            js1L3.put("reponse1", "Moscow");
            js1L3.put("reponse2", "Paris");
            js1L3.put("reponse3", "Madrid");
            js1L3.put("reponse4", "Kaliningrad");

            js2L3.put("questionText", "La capitale d'Italy (Local L3)");
            js2L3.put("urlVideo", "null");
            js2L3.put("reponse1", "Rome");
            js2L3.put("reponse2", "Berlin");
            js2L3.put("reponse3", "Kiev");
            js2L3.put("reponse4", "Kabul");

            js3L3.put("questionText", "La capitale d'Espagne (Local L3)");
            js3L3.put("urlVideo", "null");
            js3L3.put("reponse1", "Madrid");
            js3L3.put("reponse2", "Berlin");
            js3L3.put("reponse3", "Kiev");
            js3L3.put("reponse4", "Kabul");

            jsALevel1.put(js1L1);
            jsALevel1.put(js2L1);
            jsALevel1.put(js3L1);
            jsALevel1.put(js4L1);

            jsALevel2.put(js1L2);
            jsALevel2.put(js2L2);
            jsALevel2.put(js3L2);

            jsALevel3.put(js1L3);
            jsALevel3.put(js2L3);
            jsALevel3.put(js3L3);

            this.firstJsObj = new JSONObject();
            this.firstJsObj.put("level1",jsALevel1);
            this.firstJsObj.put("level2",jsALevel2);
            this.firstJsObj.put("level3",jsALevel3);



        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void writeToFile(){
        try {
            OutputStreamWriter outputStreamWriter = new OutputStreamWriter(context.openFileOutput(FILE_NAME, Context.MODE_PRIVATE));
            outputStreamWriter.write(this.firstJsObj.toString());
            outputStreamWriter.close();
        } catch (IOException e) {
            Log.e("Exception", "File write failed: " + e.toString());
        }
    }

    /*** La méthode ajouterQuestion() ajoute la question passée en paramètre dans le fichier en local. ***/
    public void ajouterQuestion(Question myNewQuestion){

        if (this.levelOfQuestion != null){
            JSONObject jsonObject = new JSONObject();

            try {
                jsonObject.put("questionText",myNewQuestion.getQuestionText());
                jsonObject.put("urlVideo", "null");
                jsonObject.put("reponse1", myNewQuestion.getReponse1());
                jsonObject.put("reponse2", myNewQuestion.getReponse2());
                jsonObject.put("reponse3", myNewQuestion.getReponse3());
                jsonObject.put("reponse4", myNewQuestion.getReponse4());
            } catch (JSONException e) {
                e.printStackTrace();
            }

            this.firstJsObj.optJSONArray(this.levelOfQuestion).put(jsonObject);
            this.firstJsObj.toString();
        }

        writeToFile();
    }

    /*** La fonction "obtListAvecQuestionsDeJsObj" obtient le niveau(level) choisie par l'utilisateur et retourne un tableau avec des questions qu'appartient à ce niveau ***/
    public List<Question> obtListAvecQuestionsDeJsObj(String level){
        String defautLevel = "level1" ;
        String questionText, urlVideo, reponse1, reponse2, reponse3, reponse4;
        List<Question> listeAvecLesQuestions = new ArrayList<>();

        if (level == null)
            level = defautLevel;

        //===***Obtiens un tableau json à partir de niveau  ***===//
        JSONArray arrayJSQuestions = this.firstJsObj.optJSONArray(level);

        //===***On crée le tableau avec les questions de format "String" on parcourant les objets de tableau json  ***===//
        for (int i = 0; i < arrayJSQuestions.length(); i++) {
            try {
                questionText = arrayJSQuestions.optJSONObject(i).getString("questionText");
                reponse1 = arrayJSQuestions.optJSONObject(i).getString("reponse1");
                reponse2 = arrayJSQuestions.optJSONObject(i).getString("reponse2");
                reponse3 = arrayJSQuestions.optJSONObject(i).getString("reponse3");
                reponse4 = arrayJSQuestions.optJSONObject(i).getString("reponse4");
                urlVideo = arrayJSQuestions.optJSONObject(i).getString("urlVideo");

                //===*** On insère une question avec l'url de sa vidéo dans le tableau des questions ***===//
                listeAvecLesQuestions.add(new Question(questionText, urlVideo, reponse1, reponse2, reponse3, reponse4));

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        return listeAvecLesQuestions;
    }


    public abstract void createListResponse(List<Question> listeQuestions);
    public abstract String getLevel();
}
