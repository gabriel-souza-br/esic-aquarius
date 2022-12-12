<template>
  <div class="justify-center items-center">
    <div class="q-pa-sm">
      <div class="row">
        <q-card square class="shadow-2" style="width: 400px">
          <q-card-section class="bg-blue-grey-10">
            <h5 class="text-h5 text-white q-my-sm">
              {{ this.dados.cadastrar ? "Cadastro" : "Login" }}
            </h5>
          </q-card-section>
          <q-card-section>
            <q-fab
              color="primary"
              @click="dados.cadastrar = !dados.cadastrar"
              icon="person_add"
              class="absolute"
              style="top: 0; right: 12px; transform: translateY(-50%)"
            >
            </q-fab>
            <q-form class="q-px-sm q-pt-md">
              <!-- Campo de CPF/CNPJ -->
              <q-input
                ref="cpfcnpj"
                @keydown="setCpfCnpjMascara"
                @keyup="clearBackendItemErrors('cpfcnpj')"
                square
                clearable
                v-model="dados.cpfcnpj"
                unmasked-value
                :mask="form.cpfcnpj_mascara"
                lazy-rules
                :rules="[this.required, this.cpfcnpj]"
                type="text"
                label="CPF/CNPJ"
                :error-message="getBackendItemErrors('cpfcnpj')"
                :error="hasBackendItemErrors('cpfcnpj')"
              >
                <template v-slot:prepend>
                  <q-icon name="person" />
                </template>
              </q-input>

              <!-- Campo de Nome -->
              <q-input
                ref="nome"
                v-if="dados.cadastrar"
                square
                clearable
                type="text"
                v-model="dados.nome"
                lazy-rules
                :rules="[this.required, this.tamanho_minimo_5]"
                :label="`${
                  form.cpfcnpj_mascara === '###.###.###-##'
                    ? 'Nome'
                    : 'Razão Social'
                }`"
                :error-message="getBackendItemErrors('nome')"
                :error="hasBackendItemErrors('nome')"
              >
                <template v-slot:prepend>
                  <q-icon name="person" />
                </template>
              </q-input>

              <!-- Campo de E-mail -->
              <q-input
                ref="email"
                v-if="dados.cadastrar"
                square
                clearable
                v-model="dados.email"
                type="email"
                lazy-rules
                :rules="[this.required, this.email, this.tamanho_minimo_5]"
                label="Email"
                :error-message="getBackendItemErrors('email')"
                :error="hasBackendItemErrors('email')"
              >
                <template v-slot:prepend>
                  <q-icon name="email" />
                </template>
              </q-input>

              <!-- Campo de Senha -->
              <q-input
                ref="password"
                @keyup="clearBackendItemErrors('password')"
                square
                clearable
                v-model="dados.password"
                :type="form.password_tipo"
                lazy-rules
                :rules="[this.required, this.tamanho_minimo_8]"
                label="Senha"
                :error-message="getBackendItemErrors('password')"
                :error="hasBackendItemErrors('password')"
              >
                <template v-slot:prepend>
                  <q-icon name="lock" />
                </template>
                <template v-slot:append>
                  <q-icon
                    :name="`${
                      form.password_tipo === 'password'
                        ? 'visibility'
                        : 'visibility_off'
                    }`"
                    @click="setVisualizarSenha"
                    class="cursor-pointer"
                  />
                </template>
              </q-input>

              <!-- Campo de Confirmação de Senha -->
              <q-input
                ref="password_confirmation"
                v-if="dados.cadastrar"
                square
                clearable
                v-model="dados.password_confirmation"
                :type="form.password_tipo"
                lazy-rules
                :rules="[
                  this.required,
                  this.tamanho_minimo_8,
                  this.password_confirmation,
                ]"
                label="Repetir Senha"
                :error-message="getBackendItemErrors('password_confirmation')"
                :error="hasBackendItemErrors('password_confirmation')"
              >
                <template v-slot:prepend>
                  <q-icon name="lock" />
                </template>
                <template v-slot:append>
                  <q-icon
                    :name="`${
                      form.password_tipo === 'password'
                        ? 'visibility'
                        : 'visibility_off'
                    }`"
                    @click="setVisualizarSenha"
                    class="cursor-pointer"
                  />
                </template>
              </q-input>
            </q-form>
          </q-card-section>

          <q-card-actions class="q-px-lg">
            <!-- Botão de Envio -->
            <q-btn
              unelevated
              size="lg"
              color="secondary"
              @click="submit"
              class="full-width text-white"
              :label="`${this.dados.cadastrar ? 'Cadastrar' : 'Enviar'}`"
              :loading="carregando"
            />
          </q-card-actions>
          <!-- Esqueci minha senha -->
          <q-card-section v-if="!dados.cadastrar" class="text-center q-pa-sm">
            <p class="text-grey-6">Esqueci minha senha</p>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script>
import { backendValidation } from "@/services/validation/backend.validation.service";
import {
  required,
  email,
  cpfcnpj,
  password_confirmation,
  tamanho_minimo_5,
  tamanho_minimo_8,
} from "@/services/validation/frontend.validation.service";

export default {
  name: "LoginRegisterComponent",
  setup() {
    const {
      setBackendErrors,
      getBackendItemErrors,
      hasBackendItemErrors,
      clearBackendItemErrors,
    } = backendValidation();
    return {
      setBackendErrors,
      getBackendItemErrors,
      hasBackendItemErrors,
      clearBackendItemErrors,
    };
  },
  data() {
    return {
      dados: {
        cpfcnpj: "",
        nome: "",
        email: "",
        password: "",
        password_confirmation: "",
        cadastrar: false /* Define se é um "cadastro" ou "login" */,
      },
      form: {
        cpfcnpj_mascara:
          "###.###.###-##" /* Será "##.###.###/####-##" quando for do CNPJ */,
        password_tipo:
          "password" /* Será "text" quando houver clique para mostrar a senha */,
      },
      carregando: false,
    };
  },

  methods: {
    /*==========REGRAS DE VALIDAÇÃO==========*/
    required(val) {
      return required(val);
    },
    cpfcnpj(val) {
      return cpfcnpj(val);
    },
    email(val) {
      return email(val);
    },
    password_confirmation(val) {
      return password_confirmation(val, this.$refs.password.value);
    },
    tamanho_minimo_5(val) {
      return tamanho_minimo_5(val);
    },
    tamanho_minimo_8(val) {
      return tamanho_minimo_8(val);
    },

    /*==================================
     * Valida e envia o formulário se estiver válido
     *==================================
     */
    submit() {
      const campos_alvos = this.dados.cadastrar
        ? ["cpfcnpj", "nome", "email", "password", "password_confirmation"]
        : ["cpfcnpj", "password"];

      //Faz a validação no Frontend dos campos (login ou cadastro dependendo)
      campos_alvos.forEach((element) => this.$refs[element].validate());

      //Login
      if (!this.dados.cadastrar) {
        if (!this.$refs.cpfcnpj.hasError && !this.$refs.password.hasError) {
          this.carregando = true;
          this.$store
            .dispatch("auth/login", {
              cpfcnpj: this.dados.cpfcnpj,
              password: this.dados.password,
            })
            .then(
              () => {
                this.carregando = false;
                this.$router.push("/painel");
              },
              (error) => {
                const resp = error.response;
                if (resp.status === 422 /*Unprocessable Content*/) {
                  this.setBackendErrors(resp.data.mensagens);
                }
                this.carregando = false;
              }
            );
        }
      }
    },

    /*Mostra ou esconde senha*/
    setVisualizarSenha() {
      this.form.password_tipo =
        this.form.password_tipo === "password" ? "text" : "password";
    },

    /*==================================
     * Altera a máscara do campo cpfcnpj dependendo da quantdade de dígitos escritos
     *==================================
     */
    setCpfCnpjMascara: function (e) {
      var regX = new RegExp("([0-9])");
      var tamanho = this.dados.cpfcnpj.length;

      if (tamanho < 11) {
        /*Se tiver menos que 11 dígitos então qualquer nova tecla implicará em CPF (seja Dígito ou Backspace)*/
        this.form.cpfcnpj_mascara = "###.###.###-##";
      } else if (tamanho === 11 || tamanho === 12) {
        /*Se tiver (11 ou 12) dígitos então se a nova tecla for: */
        if (regX.test(e.key)) {
          /* i) "Dígito" então será CNPJ; */
          this.form.cpfcnpj_mascara = "##.###.###/####-##";
        } else if (e.key === "Backspace") {
          /* ii) "Backspace" então será CPF */
          tamanho === 12 ? e.preventDefault() : ""; //Evita a máscara apagar o 12 caracter e o Backspace apagar o 11 de uma vez (em casos de 12 dígitos apenas)
          this.form.cpfcnpj_mascara = "###.###.###-##";
        }
      } else if (tamanho > 12) {
        /*Se tiver mais que 12 dígitos então qualquer nova tecla implicará em CNPJ (seja Dígito ou Backspace)*/
        this.form.cpfcnpj_mascara = "##.###.###/####-##";
      }
    },
  },
};
</script>