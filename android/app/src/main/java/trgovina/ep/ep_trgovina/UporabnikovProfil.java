package trgovina.ep.ep_trgovina;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.models.UporabnikResponse;

public class UporabnikovProfil extends AppCompatActivity implements Callback<UporabnikResponse> {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_uporabnikov_profil);
    }

    @Override
    public void onResponse(Call<UporabnikResponse> call, Response<UporabnikResponse> response) {
        
    }

    @Override
    public void onFailure(Call<UporabnikResponse> call, Throwable t) {

    }
}
