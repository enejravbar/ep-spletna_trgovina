package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.adapters.PostaAdapter;
import trgovina.ep.ep_trgovina.models.Posta;
import trgovina.ep.ep_trgovina.models.Uporabnik;
import trgovina.ep.ep_trgovina.models.UporabnikResponse;
import trgovina.ep.ep_trgovina.seja.SessionVar;

public class UporabnikovProfil extends AppCompatActivity implements Callback<UporabnikResponse> {

    private EditText upbIme;
    private EditText upbPriimek;
    private EditText upbEmail;
    private EditText upbNaslov;
    private Spinner upbPosta;
    private EditText upbGeslo;
    private Button gumbPreklici;
    private Button gumbShrani;
    private Uporabnik uporabnik;
    private PostaAdapter postaAdapter;
    private Posta posta;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_uporabnikov_profil);

        upbIme = (EditText) findViewById(R.id.upb_ime);
        upbPriimek = (EditText) findViewById(R.id.upb_priimek);
        upbEmail = (EditText) findViewById(R.id.upb_email);
        upbNaslov = (EditText) findViewById(R.id.upb_naslov);
        upbPosta = (Spinner) findViewById(R.id.upb_posta);
        upbGeslo = (EditText) findViewById(R.id.upb_geslo);

        gumbPreklici = (Button) findViewById(R.id.gumb_preklici);
        gumbShrani = (Button) findViewById(R.id.gumb_shrani);

        SessionVar session = (SessionVar) getApplicationContext();
        if(session != null){
            uporabnik = session.prijavljeniUporabnik;
        } else {
            Toast.makeText(UporabnikovProfil.this, "Napaka pri pridobivanju podatkov uporabnika!", Toast.LENGTH_LONG).show();
            return;
        }

        upbIme.setText(uporabnik.ime);
        upbPriimek.setText(uporabnik.priimek);
        upbNaslov.setText(uporabnik.naslov);
        upbEmail.setText(uporabnik.email);

        upbPosta.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                posta = postaAdapter.getItem(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        gumbShrani.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                posodobiUporabnika();
                Intent intent = new Intent(UporabnikovProfil.this, GlavnaStran.class);
                startActivity(intent);
            }
        });

        gumbPreklici.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(UporabnikovProfil.this, GlavnaStran.class);
                startActivity(intent);
            }
        });

        UporabnikService.getInstance().get(uporabnik.id).enqueue(UporabnikovProfil.this);

    }

    private void posodobiUporabnika(){
        UporabnikService.getInstance().update(
                uporabnik.id,
                uporabnik.vloga,
                upbIme.getText().toString(),
                upbPriimek.getText().toString(),
                upbGeslo.getText().toString(),
                upbEmail.getText().toString(),
                upbNaslov.getText().toString(),
                posta.postna_st
        ).enqueue(new Callback<Uporabnik>() {
            @Override
            public void onResponse(Call<Uporabnik> call, Response<Uporabnik> response) {
                Toast.makeText(UporabnikovProfil.this, "Profil posodobljen!", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(Call<Uporabnik> call, Throwable t) {
                Toast.makeText(UporabnikovProfil.this, "Napaka pri posodabljanju profila!", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public void onResponse(Call<UporabnikResponse> call, Response<UporabnikResponse> response) {
        UporabnikResponse uporabnikResponse = response.body();
        postaAdapter = new PostaAdapter(this, R.layout.image_item, uporabnikResponse.poste);
        upbPosta.setAdapter(postaAdapter);
    }

    @Override
    public void onFailure(Call<UporabnikResponse> call, Throwable t) {
        Toast.makeText(UporabnikovProfil.this, "Napaka pri pridobivanju podatkov uporabnika!", Toast.LENGTH_LONG).show();
    }
}
