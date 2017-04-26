<template>
	<button id="megusta" class="btn btn-default btn-block">
	<span class="glyphicon" v-bind:class="[id == -1 ? 'glyphicon-heart-empty' : 'glyphicon-heart']"></span>
	</button>
</template>

<script>
    export default {
    	data(){
    		return{
    			peticionTerminada : true,
    			botonSpan: '',
    			_id: ''
    		}
    	},
    	mounted() {
    		const _this = this;
    		_this._id = _this.id;
    		_this.botonSpan = $("#megusta span");
    		//TODO: mover este código en funcion onClick que sea llamado en v-on:click
        	$("#megusta").click(function(){
        		if(_this.peticionTerminada){
        			_this.peticionTerminada = false;
        			_this._id == -1 ? _this.darMegusta() : _this.quitarMeGusta();
        		}
        	});
        },
        props: ['id', 'publicacion'],
        methods: {
        	darMegusta(){
        		const _this = this;
        		const datosMegusta = _this.formToken();
        		datosMegusta.append('publicacion', _this.publicacion);
        		$("#megusta").addClass("procesando");
				_this.$http.post('/megusta/crear', datosMegusta)
				.then((response) => {
        			$("#megusta").removeClass("procesando");
        			_this.botonSpan.addClass("glyphicon-heart").removeClass("glyphicon-heart-empty");
        			_this._id = response.data.id;
        			_this.peticionTerminada = true;
				});
        	},
        	quitarMeGusta(){
        		const _this = this;
        		$("#megusta").addClass("procesando");
				_this.$http.post('/megusta/'+ _this._id +'/borrar', _this.formToken())
				.then((response) => {
        			$("#megusta").removeClass("procesando");
        			_this.botonSpan.addClass("glyphicon-heart-empty").removeClass("glyphicon-heart");
        			_this._id = -1;
        			_this.peticionTerminada = true;
				});
        	},
			formToken(){
        		let token = new FormData();
        		token.append('_token', window.Laravel.csrfToken);
        		return token;
			}
        }
    }
</script>