package com.example.smarttrucker.OtherClasses;

import android.os.Parcel;
import android.os.Parcelable;

public class Utilisateur implements Parcelable {
    private String nom;
    private int points;
    private int level;
    private Camion monCamion;

    public Utilisateur(String nom, Camion monCamion) {
        this.nom = nom;
        this.points = 100;
        this.level = 1;
        this.monCamion = monCamion;
    }

    public Utilisateur(String nom, Camion monCamion, int points, int level) {
        this.nom = nom;
        this.points = points;
        this.level = level;
        this.monCamion = monCamion;
    }


    public int getPoints() {
        return points;
    }

    public int getLevel() {
        return level;
    }

    public String getNom() {
        return nom;
    }

    public void setPoints(int points) {
        this.points = points;
    }

    public void setLevel(int level) {
        this.level = level;
    }

    public Camion getMonCamion() {
        return monCamion;
    }

    public void setMonCamion(Camion monCamion) {
        this.monCamion = monCamion;
    }

    @Override
    public String toString() {
        return "Utilisateur{" +
                "nom='" + nom + '\'' +
                ", points=" + points +
                ", level=" + level +
                '}';
    }


    protected Utilisateur(Parcel in) {
        nom = in.readString();
        points = in.readInt();
        level = in.readInt();

        monCamion = (Camion) in.readParcelable(Camion.class.getClassLoader());

}

    public static final Creator<Utilisateur> CREATOR = new Creator<Utilisateur>() {
        @Override
        public Utilisateur createFromParcel(Parcel in) {
            return new Utilisateur(in);
        }

        @Override
        public Utilisateur[] newArray(int size) {
            return new Utilisateur[size];
        }
    };


    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeString(nom);
        dest.writeInt(points);
        dest.writeInt(level);


        dest.writeParcelable(monCamion, flags);
    }
}
