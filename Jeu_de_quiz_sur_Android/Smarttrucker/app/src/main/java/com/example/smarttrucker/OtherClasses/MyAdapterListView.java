package com.example.smarttrucker.OtherClasses;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.example.smarttrucker.R;

import java.util.List;

public class MyAdapterListView extends ArrayAdapter<Utilisateur> {

    private Context context;

    public MyAdapterListView(Context context, List<Utilisateur> utilisateurList) {
        super(context, 0,utilisateurList);
        this.context = context;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        String nom ="Nom : " + getItem(position).getNom();
        String points ="Points : " + Integer.toString(getItem(position).getPoints());
        String carburantActuel ="Litres de carburant : " +  Integer.toString(getItem(position).getMonCamion().getCarburantActuelLitre());


        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.save_item, parent, false);
        }

        ((TextView) convertView.findViewById(R.id.idNomSave)).setText(nom);
        ((TextView) convertView.findViewById(R.id.idNbPointSave)).setText(points);
        ((TextView) convertView.findViewById(R.id.idCarburantSave)).setText(carburantActuel);

        return convertView;
    }

}
