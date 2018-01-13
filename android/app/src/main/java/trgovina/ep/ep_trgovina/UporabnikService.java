package trgovina.ep.ep_trgovina;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;
import trgovina.ep.ep_trgovina.models.Uporabnik;
import trgovina.ep.ep_trgovina.models.UporabnikResponse;

/**
 * Created by miha on 31.12.2017.
 */

public class UporabnikService {

    interface RESTApi {
        String HOST_LOKALNEGA_RACUNALNIKA = "10.0.2.2";
        String URL = "http://" + HOST_LOKALNEGA_RACUNALNIKA + "/ep/ep-spletna_trgovina/api/";

        @GET("android/stranke/{id}")
        Call<UporabnikResponse> get(@Path("id") long id);

        @FormUrlEncoded
        @PUT("android/stranke/{id}")
        Call<Uporabnik> update(@Path("id") long id,
                               @Field("vloga") int vloga,
                               @Field("ime") String ime,
                               @Field("priimek") String priimek,
                               @Field("geslo1") String geslo1,
                               @Field("geslo2") String geslo2,
                               @Field("email") String email,
                               @Field("naslov") String naslov,
                               @Field("posta") int posta,
                               @Field("telefon") String telefon);

        @FormUrlEncoded
        @POST("android/prijava")
        Call<Uporabnik> prijavi(@Field("email") String email, @Field("geslo") String geslo);
    }

    private static RESTApi instance;

    public static synchronized RESTApi getInstance(){
        if(instance == null) {
            final Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(RESTApi.URL)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();
            instance = retrofit.create(RESTApi.class);
        }
        return instance;
    }
}
