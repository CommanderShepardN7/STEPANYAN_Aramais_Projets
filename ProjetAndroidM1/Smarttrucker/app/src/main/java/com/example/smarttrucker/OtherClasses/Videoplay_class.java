package com.example.smarttrucker.OtherClasses;

import android.os.Bundle;
import android.widget.Toast;

import com.example.smarttrucker.R;
import com.google.android.youtube.player.YouTubeBaseActivity;
import com.google.android.youtube.player.YouTubeInitializationResult;
import com.google.android.youtube.player.YouTubePlayer;
import com.google.android.youtube.player.YouTubePlayerView;


public class  Videoplay_class extends YouTubeBaseActivity implements YouTubePlayer.OnInitializedListener {


    private static final int RECOVERY_REQUEST = 1;
    private String YOUTUBE_API_KEY = "AIzaSyCHotOHEvDGY9-WtyySdSWNCCQ573a_AXI";
    private YouTubePlayerView youTubeView;
    private String UrlVideo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.videoplay_page);

        youTubeView = findViewById(R.id.videoPlayerId);
        youTubeView.initialize(YOUTUBE_API_KEY, this);

        Bundle arguments = getIntent().getExtras();
        this.UrlVideo = arguments.get("urlVideo").toString();


    }

    @Override
    public void onInitializationSuccess(YouTubePlayer.Provider provider, YouTubePlayer player, boolean wasRestored) {
        if (!wasRestored) {
            player.cueVideo(this.UrlVideo);
            player.setPlayerStyle(YouTubePlayer.PlayerStyle.MINIMAL);

        }
    }

    @Override
    public void onInitializationFailure(YouTubePlayer.Provider provider, YouTubeInitializationResult errorReason) {
        if (errorReason.isUserRecoverableError()) {
            errorReason.getErrorDialog(this, RECOVERY_REQUEST).show();
        } else {
            String error = String.format(getString(R.string.player_error), errorReason.toString());
            Toast.makeText(this, error, Toast.LENGTH_LONG).show();
        }
    }

}
