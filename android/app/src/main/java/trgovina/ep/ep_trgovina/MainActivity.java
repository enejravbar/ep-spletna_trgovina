package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.models.Uporabnik;
import trgovina.ep.ep_trgovina.seja.SessionVar;

public class MainActivity extends AppCompatActivity implements Callback<Uporabnik> {
    private static final String TAG = MainActivity.class.getCanonicalName();

    private Button gumb_prijava;
    private EditText vnos_geslo;
    private EditText vnos_upime;
    private TextView izpis_napaka;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        gumb_prijava = (Button) findViewById(R.id.prijava_gumb);
        vnos_geslo = (EditText) findViewById(R.id.vnos_geslo);
        vnos_upime = (EditText) findViewById(R.id.vnos_upime);
        izpis_napaka = (TextView) findViewById(R.id.izpis_napaka);

        gumb_prijava.setOnClickListener( new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                izpis_napaka.setText("");
                UporabnikService
                        .getInstance()
                        .prijavi(vnos_upime.getText().toString(), vnos_geslo.getText().toString())
                        .enqueue(MainActivity.this);
            }
        });

    }

    @Override
    public void onResponse(Call<Uporabnik> call, Response<Uporabnik> response) {
        final Uporabnik prijavljeniUporabnik = response.body();

        if(prijavljeniUporabnik == null){
            izpis_napaka.setText("Napačen e-mail in/ali geslo!");
        } else {
            SessionVar session = (SessionVar) getApplicationContext();
            if(session != null){
                session.prijavljeniUporabnik = prijavljeniUporabnik;
                Intent intent = new Intent(MainActivity.this, GlavnaStran.class);
                startActivity(intent);
            } else {
                izpis_napaka.setText("Napaka pri prijavi!");
            }
        }
    }

    @Override
    public void onFailure(Call<Uporabnik> call, Throwable t) {
        Log.e(TAG, "Napaka: " + t.getMessage(), t);
        izpis_napaka.setText("Napaka pri pridobivanju podatkov!");
    }

    @Override
    public void onBackPressed() {
        SessionVar session = (SessionVar) getApplicationContext();
        if(session != null){
            if(session.prijavljeniUporabnik != null){
                super.onBackPressed();
            }
        }
    }
}
