<template>
	<button id="subscripcion" class="btn btn-default btn-block" v-on:click="onClick($event)">
        {{id == -1 ? 'Seguir' : 'Dejar de seguir'}}
	</button>
</template>

<script>
    export default {
    	data(){
    		return{
    			peticionTerminada : true,
    			_id: ''
    		}
    	},
    	mounted() {
    		this._id = this.id;
        },
        props: ['id', 'club'],
        methods: {
        	darSeguir(boton){
        		const _this = this;
        		const datosSubscripcion = _this.formToken();
        		datosSubscripcion.append('club', _this.club);
        		boton.addClass('procesando');
				_this.$http.post('/subscripcion/crear', datosSubscripcion)
				.then((response) => {
        			boton.removeClass("procesando");
                    boton.html('Dejar de seguir');
        			_this._id = response.data.id;
        			_this.peticionTerminada = true;
				});
        	},
        	quitarSeguir(boton){
        		const _this = this;
        		boton.addClass("procesando");
				_this.$http.post('/subscripcion/'+ _this._id +'/borrar', _this.formToken())
				.then((response) => {
        			boton.removeClass("procesando");
        			boton.html('Seguir');
        			_this._id = -1;
        			_this.peticionTerminada = true;
				});
        	},
			formToken(){
        		let token = new FormData();
        		token.append('_token', window.Laravel.csrfToken);
        		return token;
			},
            onClick(event)
            {
                const boton = $(event.target);
                if(this.peticionTerminada){
                    this.peticionTerminada = false;
                    this._id == -1 ? this.darSeguir(boton) : this.quitarSeguir(boton);
                }
            }
        }
    }
</script>