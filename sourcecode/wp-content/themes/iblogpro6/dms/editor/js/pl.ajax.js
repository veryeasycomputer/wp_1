!function ($) {


	/*
	 * AJAX Actions
	 */
	$.plAJAX = {

		// Generalized AJAX Function
		run: function( args ){

			var	that = this
			,	theData = {
						action: 'pl_editor_actions'
					,	mode: 'default'
					,	run: 'default'
					,	pageID: $.pl.config.pageID
					,	typeID: $.pl.config.typeID
					,	log: false
					,	confirm: false
					, 	confirmText: $.pl.lang( "Are you sure?" )
					,	savingText: 'Saving'
					,	refresh: 	false
					,	refreshText: $.pl.lang( "Refreshing page..." )
					,	refreshArgs: false
					, 	toolboxOpen: $.toolbox('open')
					,	beforeSend: ''
					, 	postSuccess: ''
					,	load: false
					,	onFalse: ''

				}

			// merge args into theData, overwriting theData w/ args
			$.extend(theData, args)

			if( theData.confirm ){

				if( theData.toolboxOpen && ( theData.refresh || theData.confirm ) )
					$.toolbox('hide')

				bootbox.confirm( theData.confirmText, function( result ){

					if( false == result && theData.onFalse ) {
						if ( $.isFunction( theData.onFalse ) )
							theData.onFalse.call()
					}


					if(result == true){
						that.runAction( theData )
					} else {

						if( theData.toolboxOpen && ( theData.refresh || theData.confirm ) )
							$('body').toolbox('show')
					}

				})

			} else {

				that.runAction( theData )

			}


			return ''
		}

		, runAction: function( theData ){

			var that = this
			
			// Note that nested objects must be of consistent type, mixed numeric/associative objects cannot be passed.
			$.ajax( {
					type: 'POST'
				, 	url: ajaxurl
				, 	data: theData
				//,	dataType: 'json'
				, 	beforeSend: function(){

						$('.btn-saving')
							.addClass('active')
							.find('.icon')
								.addClass('icon-spin')

						if ( $.isFunction( theData.beforeSend ) )
							theData.beforeSend.call( this )

						if( theData.refresh ){

							$.toolbox('hide')
							$.pl.flags.refreshing = true
							bootbox.dialog( that.dialogText( theData.savingText ), [ ], {animate: false})
						}

					
						$.pl.flags.saving = true
					}
				
				, 	success: function( response ){
					
						plPrint(response)
						
						var rsp	= $.parseJSON( response )
						
						$.pl.flags.saving = false
						
						that.runSuccess( theData, rsp )

						if( theData.refresh ){

							// reopen toolbox after load if it was shown
							if( theData.toolboxOpen )
								store.set('toolboxShown', true)

							bootbox.dialog( that.dialogText( theData.refreshText ), [ ], {animate: false})
							
							window.onbeforeunload = null
							
							if( plIsset( rsp.url ) &&  rsp.url != '' ){
								
								window.location.href = rsp.url
								
							} else if( theData.refreshArgs ){
								
								var url = window.location.href
								url += (url.indexOf('?') > -1) ? '&'+theData.refreshArgs : '?'+theData.refreshArgs
								
								window.location.href = url
								
							} else{
								location.reload()
								
							//	console.log()
							}
								

						} else {

							if( theData.toolboxOpen && theData.confirm && !$.pl.flags.refreshing )
								$('body').toolbox('show')

						}

					}
					
				, 	error: function( jqXHR, status, error ){
						$.pl.flags.saving = false
						plPrint('- AJAX Error -')
						plPrint( jqXHR )
						plPrint( status )
						plPrint( error )
					}
			})
		}

		, runSuccess: function( theData, rsp ){
			
			var that = this
			,	log = (rsp.post) ? rsp.post.log || false : ''

			if( log == 'true' )
				plPrint( rsp )

			if ( $.isFunction( theData.postSuccess ) )
				theData.postSuccess.call( this, rsp )

			that.ajaxSuccess(rsp)
		}

		, init: function(){


			this.bindUIActions()

		}

		, saveData: function( opts ){
			
			var args = {
					mode: 'save'
				,	savingText: $.pl.lang("Saving Settings")
				,	refresh: false
				,	refreshText: $.pl.lang("Settings successfully saved! Refreshing page...")
				, 	log: true
				,	pageData: $.pl.data
				,	run: 'draft'
			}
			
			$.pageBuilder.updatePage({ location: 'save-data' })

			$.extend( args, opts )

			var response = $.plAJAX.run( args )

		}



		, toggleEditor: function(){

			var that = this
			,	theData = {
					action: 'pl_editor_mode'
					,	userID: $.pl.config.userID
				}

			confirmText = $.pl.lang( "<h3>Turn Off DMS Editor?</h3><p>(Note: Draft mode is disabled when editor is off.)</p>" )
			bootbox.confirm( confirmText, function( result ){
				if(result == true){
					$.ajax( {
						type: 'POST'
						, url: ajaxurl
						, data: theData
						, beforeSend: function(){
							bootbox.dialog( that.dialogText($.pl.lang( "Deactivating..." ) ), [], {animate: false})
						}
						, success: function( response ){


							bootbox.dialog( that.dialogText($.pl.lang( "Editor deactivated! Reloading page.") ), [], {animate: false})
							
							window.location = $.pl.config.currentURL
						}
					})
				}
			})

		}

		, bindUIActions: function(){

			var that = this

			$( '.btn-publish' ).on('click.saveButton', function(){


				$.plSave.save( { 
					run: 'publish'
					, store: $.plDatas.GetUIDs()
					, log: true
				} )


			})
			
			$( '.btn-refresh' ).on('click.saveButton', function(){
				
				$(this).find('i').addClass('icon icon-spin')
				
				window.onbeforeunload = null

				plCallWhenSet( 'saving', function(){
					
					location.reload()
				
				}, true )
			

			})


			$('.btn-revert').on('click.revertbutton', function(e){
					e.preventDefault()

					var revert = $(this).data('revert')
					,	args = {
								mode: 'save'
							,	run: 'revert'
							,	confirm: true
							,	confirmText: sprintf( $.pl.lang( "<h3>Are you sure?</h3><p>This will revert <strong>%s</strong> changes to your last published configuration.</p>" ), revert )
							,	savingText: $.pl.lang( "Reverting Draft" )
							,	refreshText: $.pl.lang( "Template successfully updated!" )
							,	refresh: true
							, 	log: true
							,	revert: revert
						}

					var response = $.plAJAX.run( args )


			})





		}


		, ajaxSuccess: function( response ){

				var state = response.state || false

				$('.btn-saving')
					.removeClass('active')
					.find('.icon')
						.removeClass('icon-spin')

				$('#stateTool').attr('class', 'dropup')

				$.each(state, function(index, el){
					
					$('#stateTool').addClass(el)
				})
				
			
		}


		, dialogText: function( text ){

			var dynamo = '<div class="pl-spinner"></div>'
			, 	theHTML = sprintf('<div class="spn">%s<div class="ttl">%s</div></div>', dynamo, text)
			
			
			return theHTML


		}
	}



}(window.jQuery);