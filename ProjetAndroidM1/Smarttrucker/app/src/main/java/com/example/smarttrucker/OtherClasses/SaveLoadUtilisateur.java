package com.example.smarttrucker.OtherClasses;

import android.content.Context;
import android.util.Log;

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

public class SaveLoadUtilisateur {

    private Context context;
    private static String FILE_NAME = "saveUtilisateurs.json"; // Nom du fichier
    private JSONObject jsObjectAvecUtilisateurs;
    private Utilisateur utilisateur;

    //Constructeur pour charger la liste des utilisateurs.
    public SaveLoadUtilisateur(Context context) throws JSONException {
        this.context = context;
        read();
    }

    //Constructeur pour ajouter ou mettre à jour l'utilisateur.
    public SaveLoadUtilisateur(Utilisateur utilisateur, Context context) throws JSONException {
        this.utilisateur = utilisateur;
        this.context = context;
        read();//On lit le fichier sauvegardé précédemment et on met à jour l'attribut 'jsObjectAvecUtilisateurs'.
        setUtilisateur(this.utilisateur);//On ajoute ou on met à jour l'utilisateur.
    }

    private void initJsObject() throws JSONException {
        JSONArray jsArray = new JSONArray();
        this.jsObjectAvecUtilisateurs = new JSONObject();
        this.jsObjectAvecUtilisateurs.put("", jsArray);
    }

    private void read() throws JSONException {
        initJsObject(); //On initialise l'objet Json.
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
                jsObjectAvecUtilisateurs = new JSONObject(builder.toString()); //===*** Met à  jour l'attribut json selon le contenu du fichier  ***===//
            }
        } catch (FileNotFoundException e) {

        } catch (IOException ioException) {
            ioException.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    //Sauvegarde de l'objet 'jsObjectAvecUtilisateurs' dans un fichier.
    private void writeToFile(){
        try {
            OutputStreamWriter outputStreamWriter = new OutputStreamWriter(context.openFileOutput(FILE_NAME, Context.MODE_PRIVATE));
            outputStreamWriter.write(this.jsObjectAvecUtilisateurs.toString());
            outputStreamWriter.close();
        } catch (IOException e) {
            Log.e("Exception", "File write failed: " + e.toString());
        }
    }

    //On ajoute ou on met à jour l'utilisateur.
    private void setUtilisateur(Utilisateur utilisateur) throws JSONException {

        int indiceUtilisateur = indiceUtilisateur(utilisateur);

        //Lorsque l'utilisateur n'est pas dans la liste.
        if (indiceUtilisateur!= -1){
            jsObjectAvecUtilisateurs.optJSONArray("").put(indiceUtilisateur,creerJsArrayUtilisateur(utilisateur));
        }else
            jsObjectAvecUtilisateurs.optJSONArray("").put(creerJsArrayUtilisateur(utilisateur));

        //On sauvegarde de notre objet Json avec tous les utilisateurs dans un fichier.
        writeToFile();

    }


    //On cherche l'indice de l'utilisateur dans le tableau, si on le ne trouve pas on retourne '-1'
    private int indiceUtilisateur(Utilisateur utilisateur) throws JSONException {
        int i = 0;

        if(jsObjectAvecUtilisateurs != null) {
            JSONArray arrayUtilisateurCamion = jsObjectAvecUtilisateurs.optJSONArray("");
            while (i < arrayUtilisateurCamion.length()) {
                if (arrayUtilisateurCamion.getJSONArray(i).getJSONObject(0).getString("name").equals(utilisateur.getNom()))
                    return i;
                i++;
            }
        }
        return -1;
    }


    //On ajoute un nouvel utilisateur dans le tableau JSon.
    private JSONArray creerJsArrayUtilisateur(Utilisateur utilisateur){
        JSONArray arrayAvecUtilisateurs = new JSONArray();
        JSONArray arrayUtilisateurCamion = new JSONArray();
        JSONObject jsObjUtilisateur = new JSONObject();
        JSONObject jsObjCamion = new JSONObject();


        try {
            //On creer des objets js pour utilisateur
            jsObjUtilisateur.put("name", utilisateur.getNom());
            jsObjUtilisateur.put("points", utilisateur.getPoints());
            jsObjUtilisateur.put("level", utilisateur.getLevel());

            //On creer des objets js pour pour le camion d'utilisateur
            jsObjCamion.put("nom", utilisateur.getMonCamion().getNom());
            jsObjCamion.put("reservoirMaxLitre", utilisateur.getMonCamion().getReservoirMaxLitre());
            jsObjCamion.put("carburantActuelLitre", utilisateur.getMonCamion().getCarburantActuelLitre());
            jsObjCamion.put("etat", utilisateur.getMonCamion().getEtat());

            //Array avec les infos sur l'utilisateur et son camion
            arrayUtilisateurCamion.put(jsObjUtilisateur);
            arrayUtilisateurCamion.put(jsObjCamion);


        } catch (JSONException e) {
            e.printStackTrace();
        }
        return  arrayUtilisateurCamion;


    }

    //On transforme le tableau Json dans la liste avec des utilisateurs.
    public List<Utilisateur>  getListUtilisateursFromJsObject() throws JSONException {
        List<Utilisateur> listUtilisateurs = new ArrayList<>();

        JSONArray arrayAvecUtilisateurs;
        arrayAvecUtilisateurs = jsObjectAvecUtilisateurs.optJSONArray("");

        for(int i = 0; i < arrayAvecUtilisateurs.length(); i++){
            JSONArray unUtilisateur = arrayAvecUtilisateurs.getJSONArray(i);

            //On recupere les données sur un utilisateur de fichier Json
            String nameSave = unUtilisateur.getJSONObject(0).getString("name");
            int pointsSave = Integer.parseInt(unUtilisateur.getJSONObject(0).getString("points"));
            int levelSave = Integer.parseInt(unUtilisateur.getJSONObject(0).getString("level"));

            //On recupere les données sur le camion d'un utilisateur de fichier Json
            String nameCamionSave = unUtilisateur.getJSONObject(1).getString("nom");
            int reservoirMaxLitreCamionSave = Integer.parseInt(unUtilisateur.getJSONObject(1).getString("reservoirMaxLitre"));
            int carburantActuelLitreCamionSave = Integer.parseInt(unUtilisateur.getJSONObject(1).getString("carburantActuelLitre"));
            int etatSaveCamionSave = Integer.parseInt(unUtilisateur.getJSONObject(1).getString("etat"));

            //On crée un utilisateur avec les informations récupérées de fichier. Json
            Camion monCamion = new Camion(nameCamionSave,reservoirMaxLitreCamionSave,carburantActuelLitreCamionSave,etatSaveCamionSave);
            Utilisateur monUtilisateur = new Utilisateur(nameSave,monCamion,pointsSave,levelSave);

            //On ajoute cet utilisateur dans la liste avec tous les utilisateurs.
            listUtilisateurs.add(monUtilisateur);

        }

        return listUtilisateurs;

    }
    

}
