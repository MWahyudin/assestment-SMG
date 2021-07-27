<template>
    <div class="grid grid-cols-3 gap-4">
        <div class="...">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="mt-6 mb-2">Provinsi asal / pengirim</h1>
                <vue-select
                    :options="list.province"
                    placeholder="Pilih provinsi asal"
                    label-by="province"
                    v-model="selectedProvinceOrigin"
                ></vue-select>

                <h1 class="mt-2 mb-2">Kota asal / pengirim</h1>
                <vue-select
                    :options="list.cityOrigin"
                    placeholder="Pilih kota asal"
                    label-by="city_name"
                    v-model="selectedCityOrigin"
                ></vue-select>

                <h1 class="mt-2 mb-2">Provinsi tujuan / peneriman</h1>
                <vue-select
                    :options="list.province"
                    placeholder="Pilih provinsi tujuan"
                    label-by="province"
                    v-model="selectedProvinceDestination"
                ></vue-select>

                <h1 class="mt-2 mb-2">Kota tujuan / penerima</h1>
                <vue-select
                    :options="list.cityDestination"
                    placeholder="Pilih kota tujuan"
                    label-by="city_name"
                    v-model="selectedCityDestination"
                ></vue-select>

                <h1 class="mt-2 mb-2">Berat dalam gram</h1>
                <div class="col-span-6 sm:col-span-3">
                    <input
                        type="text"
                        name="weight"
                        id="weight"
                        v-model="weight"
                        class="
                            mt-1
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            shadow-sm
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                    />
                </div>

                <h1 class="mt-2 mb-2">Kurir</h1>
                <vue-select
                    :options="list.kurir"
                    placeholder="Pilih kurir"
                    v-model="kurir"
                ></vue-select>

                <button
                    class="
                        bg-blue-500
                        text-white
                        px-3
                        py-2
                        rounded-md
                        text-sm
                        mt-6
                    "
                    @click.prevent="getOngkir"
                >
                    Cek ongkir
                </button>
            </div>
        </div>
        <div class="col-span-2...">
            <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
                <div class="mb-4">
                    <p class="mt-2 text-gray-600">kode :{{ ongkir.result.code }}</p>
                    <p class="mt-2 text-gray-600">nama : {{ ongkir.result.name }}</p>
                </div>
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200" v-for="(cost, i) in ongkir.result.costs" :key="i">
                        <li>
                            <a class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-between
                                        "
                                    >
                                        <p
                                            class="
                                                text-sm
                                                font-thin
                                                text-gray-700
                                                truncate
                                            "
                                        >
                                            Service : {{ cost.service}}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p
                                                class="
                                                    px-2
                                                    inline-flex
                                                    text-xs
                                                    leading-5
                                                    font-semibold
                                                    rounded-full
                                                    bg-green-100
                                                    text-green-800
                                                "
                                            >
                                                Description : {{ cost.description}}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-2 sm:flex sm:justify-between"
                                    >
                                        <div class="sm:flex">
                                            <p
                                                class="
                                                    px-2
                                                    inline-flex
                                                    text-xs
                                                    leading-5
                                                    font-semibold
                                                    rounded-full
                                                    bg-orange-100
                                                    text-green-800
                                                "
                                            >
                                                Biaya : {{cost.cost[0].value}}
                                            </p>
                                        </div>
                                        <div class="sm:flex">
                                            <p
                                                class="
                                                    px-2
                                                    inline-flex
                                                    text-xs
                                                    leading-5
                                                    font-semibold
                                                    rounded-full
                                                    bg-blue-100
                                                    text-green-800
                                                "
                                            >
                                                Estimasi : {{cost.cost[0].etd}} hari
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import VueSelect from 'vue-next-select'
import 'vue-next-select/dist/index.min.css'
import { reactive, ref, watch, onMounted } from 'vue'
export default {
    components: {
        VueSelect,
    },
     setup() {
    const selectedProvinceOrigin = ref({})
    const selectedCityOrigin = ref({})
    const selectedProvinceDestination = ref({})
    const selectedCityDestination = ref({})
    const ongkir= reactive({
        result: {
        }
    })
    const weight = ref(0)
    const kurir = ref('')
 watch(
     selectedProvinceOrigin, (val) => {
    //   console.log(currentValue);
      getOriginCityProvince(val.province_id)
    //   console.log(oldValue);
    },
    );

    watch(
     selectedProvinceDestination, (val) => {
    //   console.log(currentValue);
      getDestinationCityProvince(val.province_id)
    //   console.log(oldValue);
    },
    );
    //Master data
    const list = reactive({
        province: [],
        kurir: ['jne', 'tiki', 'pos'],
        cityOrigin: [],
        // provinceDestination: [],
        cityDestination: [],
    })

    //Get province
    const getProvince = async  function(){
        const res = await axios.get("http://127.0.0.1:8000/api/rajaongkir/province")
    //    console.log(res.data.data);
       const { data } = res.data
       list.province = data
    }

      const getOriginCityProvince = async function(id){
        const res = await axios.get(
            `http://127.0.0.1:8000/api/rajaongkir/province/${id}/city`
        )
    //    console.log(res.data.data);
       const { data } = res.data
       list.cityOrigin = data
    }

     const getDestinationCityProvince = async function(id){
        const res = await axios.get(
            `http://127.0.0.1:8000/api/rajaongkir/province/${id}/city`
        )
    //    console.log(res.data.data);
       const { data } = res.data
       list.cityDestination = data
    }

      const getOngkir = async function(){
        //   console.log(selectedCityOrigin.value.city_id);
          const params = {
            origin : selectedCityOrigin.value.city_id,     // ID kota/kabupaten asal
            destination: selectedCityDestination.value.city_id,     // ID kota/kabupaten tujuan
            weight : weight.value,    // berat barang dalam gram
            kurir: kurir.value
          }

        //   console.log(params);
        const res = await axios.post(
            "http://127.0.0.1:8000/api/rajaongkir/check", params
        )
    //    console.log(res.data.data);
       const { data } = res.data
       ongkir.result = data[0]

       console.log(ongkir.result);

    //    console.log(data);
    }

    onMounted(getProvince)
    return {
        getProvince,
      list,
      selectedProvinceOrigin,
      selectedCityOrigin,
      selectedProvinceDestination,
      selectedCityDestination,
      weight,
      kurir,
      ongkir,
      getOngkir
    }
  },

}
</script>
