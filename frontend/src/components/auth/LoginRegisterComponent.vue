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
                square
                clearable
                v-model="dados.cpfcnpj"
                unmasked-value
                :mask="form.cpfcnpj_mascara"
                lazy-rules
                :rules="[this.requerido, this.cpfcnpj]"
                type="text"
                label="CPF/CNPJ"
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
                :rules="[this.requerido, this.tamanho_minimo_5]"
                :label="`${
                  form.cpfcnpj_mascara === '###.###.###-##'
                    ? 'Nome'
                    : 'Razão Social'
                }`"
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
                :rules="[this.requerido, this.email, this.tamanho_minimo_5]"
                label="Email"
              >
                <template v-slot:prepend>
                  <q-icon name="email" />
                </template>
              </q-input>

              <!-- Campo de Senha -->
              <q-input
                ref="password"
                square
                clearable
                v-model="dados.password"
                :type="form.password_tipo"
                lazy-rules
                :rules="[this.requerido, this.tamanho_minimo_8]"
                label="Senha"
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
                  this.requerido,
                  this.tamanho_minimo_8,
                  this.cmp_password,
                ]"
                label="Repetir Senha"
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
export default {
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
    };
  },

  methods: {
    /*REGRA DE VALIDAÇÃO: Campo requerido*/
    requerido(val) {
      return (val && val.length > 0) || "Campo obrigatório!";
    },
    /*REGRA DE VALIDAÇÃO: Senha 1 e 2 devem ser iguais*/
    cmp_password(val) {
      const val2 = this.$refs.password.value;
      return (val && val === val2) || "Senhas diferentes!";
    },
    /*REGRA DE VALIDAÇÃO: Campo muito curto*/
    tamanho_minimo(val, min) {
      return (
        (val && val.length >= min) ||
        "O campo deve ter " + min + " caracteres ou mais!"
      );
    },
    tamanho_minimo_5(val) {
      return this.tamanho_minimo(val, 5);
    },
    tamanho_minimo_8(val) {
      return this.tamanho_minimo(val, 8);
    },
    /*REGRA DE VALIDAÇÃO: Campo deve ter 11 ou 14 caracteres*/
    cpfcnpj(val) {
      return (
        (val && (val.length === 11 || val.length === 14)) ||
        "CPF/CNPJ com tamanho inválido!"
      );
    },
    /*REGRA DE VALIDAÇÃO: Campo deve ter a formatação de email*/
    email(val) {
      const emailPattern =
        /^(?=[a-zA-Z0-9@._%+-]{6,254}$)[a-zA-Z0-9._%+-]{1,64}@(?:[a-zA-Z0-9-]{1,63}\.){1,8}[a-zA-Z]{2,63}$/;
      return emailPattern.test(val) || "E-mail inválido!";
    },

    /*==================================
     * Valida e envia o formulário se estiver válido
     *==================================
     */
    submit() {
      if (this.dados.cadastrar) {
        //Cadastro
        this.$refs.cpfcnpj.validate();
        this.$refs.nome.validate();
        this.$refs.email.validate();
        this.$refs.password.validate();
        this.$refs.password_confirmation.validate();
      } else {
        //Login
        this.$refs.cpfcnpj.validate();
        this.$refs.password.validate();
      }

      //Login
      if (!this.dados.cadastrar)
        if (!this.$refs.cpfcnpj.hasError && !this.$refs.password.hasError) {
          /*AuthService.login({
            cpfcnpj: this.dados.cpfcnpj,
            password: this.dados.password,
          }).then(
            //Sucesso
            (data) => {
              this.$q.notify({
                icon: "done",
                color: "positive",
                message: data[0].access_token,
                position: "top-right",
              });
            },
            //Erro
            (err) => {
              this.$q.notify({
                icon: "close",
                color: "negative",
                message: err.response.data.mensagens,
                position: "top-right",
              });
            }
          );*/

          this.$store
            .dispatch("auth/login", {
              cpfcnpj: this.dados.cpfcnpj,
              password: this.dados.password,
            })
            .then(
              () => {
                this.$router.push("/painel");
              },
              (error) => {
                this.carregando = false;
                this.requisicao.erros =
                  (error.response && error.response.data) ||
                  error.message ||
                  error.toString();
                console.log(this.requisicao.erros);
              }
            );
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