<? include_once('../func/php_header.php'); ?>
<? include_once('../func/php.php'); ?>
<? ini_set('display_errors',1); ?>
<?
$thumb_size = 100;

if( $user_cnt == 1 ){ ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gallery v3</title>
		<script type='text/javascript'>
			var jsFiles = null;
			var item_index = 0;
			var folder_index = 0;
			var index_size = 0;

			var nav_fingers = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsIAAA7CARUoSoAAAANCSURBVDhPY2ZAAnZ2dpZqamq/7t279xUqhBcEBgaKAYHew4cPn0CFGMAG1tfXs3z79qXu9evXC799+3YDSF8AyxIATExMYR8+vF+vrKzElJqaduTgwYP/GP38XKTu3H2yiJmJhZOJifnb798/ll27dnM+VA+DlZWV5cePH1cBmQJ8fHzlx48fnwaRYWDQ0lJPZGXliPr37zfXv3//fygrq8Yy3b379CQLM+uPoKBge6Cap3/+/J+kpaXxWkdH+y7I5V++fOzg5eVuUFZWNnn//n1nR0cHv46Ozj0tLa3XILUgPUFBofZAx3y9e+/2KUZHR1u3Fy9eLuDg4F7IyMgox8LCcj4gwHMD0NbvNTVtT/X0dK/Kyyukbd68+ai6utq7iIhIld+/f3Py8PBwbtiwIfDPnz8G/xn+P/rx/Wu8hIR4Atjpvr6+4kAX7VVVVf4P8gZYEApABgYF+VqD2Orqqu+ArhYCSwABSC1Ij66uzj4vLy8JkBgTiADa/rKurt5NUFC4VFBQ5BxIjBgAUsvPL1haW1vnum3bthdQYfwAnwuxAbALSQHbtm0tB8Z8tJ+fn2Fubi47VBgOMAxsa2sTnjhxIoZCEBAXF0v5/fsXw6dPH0Pv3r21cs+eXc+MjQ2rga6Gm8MIpcHAxMSo5Nu3H83//v37xsbGtkhWVnba48ePN6ioqKStW7fuKFQZHPj4+Gjcv39vHjMz09VLl66kgsRQXAjMJYXANGahoKBgxszMzADMgie+f/+uDpXGAFu2bLmhrKzi/vv3HxcHBxtnkBiKgUBX7b9+/XqDnJzc8/PnzxcCXaAgICAQJy8vjzPmN23a9JmdnW3qhw+fwqFCCAAMCw5dXd1VwFxwJDIyUgQqTBC4ujqFGBnp7wGxUVzY2NgIzIJBEZycnGcuXLhwxMXFRQ4qhRe8f/9B6O/f/6+gXOzAwsKiVEtL8xkwiRhAhXACYE5Za2Zmkg3l4gYWFqZRmprqb2NjY3G6FOgLTaCad5mZmYJQIfxAT08PmFOCwDkFGwDKr9bX16+GconLKcBS6D+UiQK8vb11fv36ZWtsbAwqxsCAoIHAQjUPmDbPQLno4KmoqGjQvHnzPkO4DAwAmm43rqjK1xkAAAAASUVORK5CYII=";

			var nav_arrows = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHoAAABQCAMAAADhsJGGAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAMAUExURQAAAG1tbW9vb3BwcHFxcXJycnNzc3V1dXZ2dnd3d3h4eHp6ent7e3x8fH19fX5+fn9/f4CAgIGBgYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6OjpCQkJGRkZKSkpSUlJWVlZaWlpeXl5iYmJubm5ycnJ2dnaGhoaKioqOjo6SkpKWlpaampqenp6ioqKmpqaqqqqurq6ysrK2tra6urq+vr7CwsLGxsbKysrOzs7S0tLW1tba2tre3t7i4uLm5ubq6uru7u7y8vL29vb6+vr+/v8DAwMHBwcLCwsPDw8TExMXFxcbGxsfHx8jIyMnJycrKysvLy8zMzM3Nzc7Ozs/Pz9DQ0NHR0dLS0tPT09TU1NXV1dbW1tfX19jY2NnZ2dra2tvb29zc3N3d3d7e3t/f3+Dg4OHh4eLi4uPj4+Tk5OXl5ebm5ufn5+jo6Onp6evr6+3t7e7u7u/v7/Dw8PHx8fLy8vT09PX19fb29vf39/j4+Pn5+fr6+vv7+/z8/P39/f7+/v///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAL6e8JwAAAEAdFJOU////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wBT9wclAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAGXRFWHRTb2Z0d2FyZQBwYWludC5uZXQgNC4wLjIx8SBplQAAB0dJREFUaEPtmot300YWh2lhm+5SiB+SRg+bQGm32zYhabAjaUYj2WkSEiAQklBem9IXUEh2U2h3a2cLSWxp/m33jj3YjsX40Rbt6Tn8OAfrXN/cT/fOndFokmONEfSVO0DXheNQGgW9NUdBXh+588J1GI2CDoJBaHLxvvAdQiOgt23Mo/cT9kYo+QjoHczRfUXINeE8hN6gB+gNWqI36IH6bWgaeISSubVfPnM9Cv9eKgH0PKVuUFhl7KeC48J9vFQSBXdtXFxhYVT/z7SHS46wJoL2HXupzsKDWvRsyoGlWygBtI/thZDVGdsP2dMiLglzEujAdhmQo4iFLHo4UxDmJNDu5+wQ0PXDkIG+S7Lgzt31jc21TcZ+vL6+tn6zLMyJtJnj2g7xGdudxRTj9uxKYqwJ4OZoyJ4VPJ8SV5gTGWtKiYfnWbg748FlkvO65Pmu7xLG/jVNoeBEmBMZa7eECV3crz22Ayh+kln7fISpUyzgIlyU5oU5kayxV6a45BOMbQJNJ6xJoKnHZ5QLE2ueUEx9YX5t6AbtZC1RgK8K3yE0CrrYLqxM5DWhd9qNLJVvv54Xn+3ywKx9b104D6GR2mwg2i6/pjabGYh23CvCdwiNgi61HxMyUfefwncIjYL+0hYEuVaE6zAaBd34fnlpYWHx0qWlRYm2hONQGgn9x+rPgt4Rn1Ltic+hdIyH+/quRFt372zdu/VNy7XRqDx+9ODBw+8fPXookfAD3bq9uXF7S4SJ6d4TcIGs778/npVLU09nzrXCNdbnHExcx3GwRGUBv3Iqm85omYyIEZOR9ptoC53VZTJ0TTcNdL7CA64VsOfD1oDA/xLZTfKXqZyW10SIV0nLjS8B+oahaYZMumHqhpHNfsUj2iSAjRjsA6XHdiS4WQXHT+GWzTwyRZC4kJGdqBxrLKsWRG/JlHin70DAbXfg8xq3tgp/Fz8mFWSUhayPoMVnrxJAy9RE77gDHx9/anTsVlrowc/r34uG5hdXbf3RaOgqZUh0Jhk0n/Lisq0E0MhUcoZx4uF7mq6ZeROuW2qhO5OLeLZHHXLz1qqPXex3vQI0d6RtNEQ2VQuh+amUoU/AstFcOHhqMXROV039+O7zU3Ctd61yvWjfKcM7V4mxHz4LKO3sm+LonG4ZenaWfTSez8Ga3EHH2kyZ0I7/WPt5DL5WTVMV1hja8fxyiZbhJbcIRtJeWHvR5hlLRTlLwYxNnWyuyS8VQ1uGerzC2N5JS7OQnssLcwxNg3lc8Pw6+6FAfRx0veQeRSMDIdOyrGLEatNjptVpozgapSqszn4+bqjIMC0kzDE09oJSgGnEnk5T2IYWhTmetWlkdcVQZtk+i8hJuJGX7BhaPfWChYxVz89Mfjp9HkkLHhSKF4uTDjvc/didnXOkbaYZ2QsXJqc+KUchq9cXxrQmmw94DJ2v1sN68ywsYmFJa9tjY33/xf4ve8+jsFZ98aLyvD3p4uj0QVivMXYAIfcPr2qc/Wr0JDAj8OQfrKQIaxztTj2OGDtkUCLw7rx396Kt/Ds8GAvBG/RvFdgSdCoXsSis71/aWN/Y/CQrrHG0780+gZ4IQ0jnwLelBc+dHV9Z21i78S0UPGK3/yLMoNi8Vo3MPmRceSudfS+lQL2EetHEcy/s1lhUB+cy7NSEOYaGJSo9Pp49PcXrs/o2n9RC8bFWM2rtkFXHkGUhmJTCHEOXsVeafBYeQLWXZvzus5SerI0JmFGacREafPVE944phobFR0nt16rv5mENsow+85qQ8tRTGL6Fi4EP+0ShXrSuKxbMWGQzdmksr7cn66uyhm/1v1WqJ3ImMmAhEuZ4mxEfYzrz34OrBVIOsHSskQVthSy9yOiYYVn9skYK3Oi5v/40bkAjIqiXUC8aOyWfYg9vTpdgKfelWUPKeZ6Ov/yuZkLIjuIFn9DySMmf4mu+oefbdxlrM+ryUzPiBrD/JXbX8WwPGkLDIOpayjRyZ3Jdm+4Y2tR1pAExbyKUb69lcTQ/k8U+cUkJEwLPMGGNjzX0OAwd35breYgtzKAmekWBLwcoe5dHdAZuFdyAH15VPxCPia6xPSrL1FVAX1bbQypV9hZE3LHnBEEq4q3xe/zoFRudo4Lmg7ePy1rz+d1Xyh146drunADLxQte/XAQGsEkhqyvQFcLi1TNrLcHH1Rih+/N9njB+8aEzs/uQZtlLPnrnpB2k9ex6zeIEgUud6zygvdF5xRdh4J/rnU6XKY0z7rhtH+zI5NPb4Bf5RxH9wuKLDUFBV9DqL1Wy3T6a45u/nFIX7lOs80+HoTWJnQD0I9TfAPcX2d4wP8tDuzwoPiAe16HvUj/rM20D+jGF0jRJFI0pGYymsnjNRpP5lt/94JhHTmq1nEGxk5z/kN91AxKa6o0rp75R+sE6dG1ZZkWl68sLXzRige6B+LHMHd61DybAQm3RuP+jdWlpcsrIkpM1/jqyNH8DCJZVRuVnSb6/6Ltxq/+6E5mIpUysQAAAABJRU5ErkJggg==";

			var thumb_video = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsEAAA7BAbiRa+0AAAHfSURBVHhe7dzBTcMwFIDhOncEo7BJmQBWKBswATvQCdiEjlLEPeE95R16ofVzno2b/p9U1a6ElOSXcyipNwAAAAAAAAAAAAAAAACAUMne3aZpepS3p3m2Kp8ppYONr8M4jjsJcpTXKsn5fdipNudeIXK8ujK+5tl6yXnuh2F4sWkzg71nkwN9s+GqyW3r2YZFdJXJtTraNJs7iBzo1oarp7dmG7poDAt6P3+Szx3klshFfbBhtpMYRQgSaGkMRZAgETEUQQJExVAEWSgyhiLIAtExFEEK1YihCFKgVgxFEKeaMRRBHGrHUATJ1CKGIkiGVjEUQS5oGUOV/D9ksuHqyan+SIw7mxaRv3ddY4JU5g3CLaszBOkMQTpDkM4QpDME6QxBOkOQzhCkMwTpDEE6Q5DOEKQzBDlDv363YTMEOSOl9C5R9jZtgiAX6I92WkYhSIaWUQiSqVUUgji0iEIQp9pRCFKgZhSCFKoVhSAL1IhCkIWioxAkQGQUggSJikKQQBFRCHKGXFz/XiULo7gfth7HUfeTuon9TrwPSp+ynzFs5eXanqPk6Xe2Z6rIfcuS4gc52FcZfs+frM9/xVDFS1LJstx5l+QVuL4t/gAAAAAAAAAAAAAAAAAAf9hsfgGma6EMwWjhrwAAAABJRU5ErkJggg==";

			var thumb_folder = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAASJSURBVHhe7Zzfi1VVFMfnHkdBEbIEC8wesofA8gf4lk5CBBrYfxGBDz72B/QP+OCjPfUvVKIWjDpSTYj2UEEiiiiWFKapjSbe6bPuWedyzr3nnLvP2Wdixvl+YLPWPndmHVjfs/fZa++5MyWEEEIIIYQQQgghhBBCCCGEEEIIsRLouW1Ev99/A7M27UXT7/V6V2nPvC+agBjv0J4sdgjxPvHwognkbprk/ZimsTtMYNoOv40Igbz1SNqnaQq7h9izmK6mwecfEraHtpCmr3uIbXzstxN1kK+1JGsuTd3SwT0eYF73265KEre1kKSjrIL2eXfJ4B4buddx2hq/tOooLHtJRI92AvdDWv6zl0hWkHixcP9FzF1zBxdWLvdpR5IkOZN2wygIwpSxhcTf8a6IhGfrSwQ57N0gCk/9/zUKVhHTboORAMsMCbLMkCDLDAmyzBhd9r6C+S3tVcPP2c7s57RvaH/bNVHKH6yy5t1vjglCq4Wl8SPa+/4romPaTFmnWR7byBBLQOMpi5/5iGH4mfmMlM2YY7T3aOvsmmjEAg/3dtpT77cS5E0E+RW7hjZLsP3+kWgI+ZsjlzPeHdBoyiLAHRPD/dcwe80XrZl1O6SRIIyG8+4aO+mvd1+04yu3Q5qOkFPuGu+6FS0gl3d5oK94d0iwIASwF8/XaW/AAbeiBYhxHTNWwzUZIbdof5qDOC9idpov2kEO5xGl790hTQT5iRf6gjkE20+wVXuq1xEX3BZoIkj+hX7IrWgBD7Sdhs6lvSKNBSGWHbocNF+05gazjb0CxggSBBEeMkVddn8b5mXzRWtKR4cROkK+RZCsvH8LX/VHHPnyoUCoIFrudgQzzL+Y/Pu4wERBCGAvoHxFKUHiuMUMMygfyggZIbbZOHgBoc0mzC7zRWt+RpDH7o8RIsgVAjw0B0Fm8FV/xFFaf2SECHIBEbK/ItRyN55oQfL1hwrCCMjhYx7ui94tpVYQAjwlwHfefZWm+iMCcmn7V7bKqmTSCLlEgOz98Ta+6o84zrqtZJIg+RMtLXcj4IE2Tnq3kkmCfOHWhpsOpOIoPZAapVIQ1LQAv7i/ibZ78IFoS+mB1CiVgiDGMABi6PwjntIDqVHqRohtKGYBVH/EU7nDm6fuHZKvPz4wX0TRXhBEWGR0ZBWl1R9bUle0gXReS5LktndrqRohtn/1uzkEs/OPDYOroi212yV5qgRR/dEtlQdSo1QJki9gVH9EwAxjWyXn0t5kxgQhwCPM9+6/gNljvmjNTaZ8+959EGUj5AYB7pmDIKo/4qk9kBqlTJCLBMj+oEHb7fEELXczygTR+Ue3BK+wjDpBtmJ0/hEBOfyH2eaSd4MYFcQ2FK+6b+cfqj/i+IEc1h5IjVIQxH6Zlp2fq/6IZ+wbUpMom7IyVH9EwsM99g2pSRS+9JnB3JfQnhCw8X+zESnk7yZmR5IkD9IrYZSOEISwbffg6lIUQYy/MPb18UZiGKUjxCDoNG07bt20JsaxfwxtxXVwMSiEEEIIIYQQQgghhBBCCCGEEEIIscKYmvoPSRJkLkSPM7oAAAAASUVORK5CYII=";
			
			var thumb_picture = "data:image/gif;base64,R0lGODlhlgCWANU9AAQCBLy+vMTCxPz+/Pz6/OTi5PTy9MTGxNza3IyOjNTS1PT29Nze3NTW1MzKzBQWFOzq7Hx+fOzu7OTm5AQGBLS2tFRWVMzOzBQSFHx6fAwODFxaXBwaHAwKDDw6PJyanBweHJSWlGxqbKyurGRiZExOTCQmJLSytHRydDw+PFxeXGxubDQ2NISChISGhGRmZCwqLExKTHR2dCwuLERCRCQiJKSipJyenDQyNIyKjERGRKyqrFRSVP///wAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjlFRThENEVGRTk4MjExRTFCQTdCOEFDQkJCNzFFMkE3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjlFRThENEYwRTk4MjExRTFCQTdCOEFDQkJCNzFFMkE3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6OUVFOEQ0RURFOTgyMTFFMUJBN0I4QUNCQkI3MUUyQTciIHN0UmVmOmRv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";
			
			var favIcon = "\ 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";
		</script>
		<? include_once('../func/html_header.php'); ?>
		<style type="text/css">
			*{
				color: gray;
			}
			body {
				background-color: black;
				background: url('img/background.jpg') repeat fixed;
				background-size: 25% 25%;

				font-family: arial,helvetica,sans-serif;
				font-size: 16px;
			}
			a, a:visited, a:active {
			  text-decoration: none;
			  color: white;
			}
			a:hover{
			  color: red;
			}
			
			#navigation{
				padding-bottom: 10px;
			}
			
			div.center{
				background: transparent;
				margin: 0 auto;
				margin-right: auto;
				text-align: center;
			}
			div.table{
				margin: 0px auto;
				/*width: calc(100% - (100% / (<? echo $thumb_size; ?>+2)+2));*/
				width: 99%;
			}
			div.index_item {
				background-color: transparent;
				float: left;
				border-collapse:collapse; 
				padding: 5px 1px;
				width: calc(<? echo $thumb_size; ?> -10px);
				height: <? echo $thumb_size; ?>px;
			}
			.thumb{
				display:block;
				width: 100px;
				height: 100px;
				object-fit: scale-down;
				margin-left: auto;
				margin-right: auto;
			}
			.linebreak{
				display: block;
				width: 100%;
				height: 1px;
				clear: both;
			}
			@media all and (orientation:portrait){
				#fullscreen_element{
					background-color: #000000;
					padding: 5px;
					margin-bottom: 3px;
					max-width: 99%;
					max-height: -webkit-calc(99vw - 55px - 20px);
					max-height:    -moz-calc(99vw - 55px - 20px);
					max-height:         calc(99vw - 55px - 20px);	  
					height: auto;
				}
			}
			@media all and (orientation:landscape){
				#fullscreen_element{
					background-color: #000000;
					padding: 5px;
					margin-bottom: 3px;
					max-width: 99%;
					max-height: -webkit-calc(99vh - 55px - 20px);
					max-height:    -moz-calc(99vh - 55px - 20px);
					max-height:         calc(99vh - 55px - 20px);	  
					height: auto;
				}
			}
			<? include_once('../func/css_loading.php'); ?>
			<? include_once('../func/css_normalize.php')?>
		</style>
		<script type='text/javascript'>
			<? include_once('../func/jquery.php'); ?>
			<? include_once('js_detectswipe.php'); ?>

			// berechnet durchschnittliche farbe eines bildes
			function getAverageRGB(name) {
				var imgEl = document.getElementById(name);

				var blockSize = 5, // only visit every 5 pixels
					defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
					canvas = document.createElement('canvas'),
					context = canvas.getContext && canvas.getContext('2d'),
					data, width, height,
					i = -4,
					length,
					rgb = {r:0,g:0,b:0},
					count = 0;

				if( imgEl == null || !context || imgEl.tagName != 'IMG') {
					return defaultRGB;
				}

				height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
				width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;
				context.drawImage(imgEl, 0, 0);

				try {
					data = context.getImageData(0, 0, width, height);
				} catch(e) {
					/* security error, img on diff domain */
					return defaultRGB;
				}

				length = data.data.length;

				while ( (i += blockSize * 4) < length ) {
					++count;
					rgb.r += data.data[i];
					rgb.g += data.data[i+1];
					rgb.b += data.data[i+2];
				}

				// ~~ used to floor values
				rgb.r = ~~(rgb.r/count);
				rgb.g = ~~(rgb.g/count);
				rgb.b = ~~(rgb.b/count);

				return rgb;
			}
			// kümmert sich um die bearbeitung von swipes und keypresses
			function handle(e){
				// swipe function what to if direction X
				//e.preventDefault(); // Ensure it is only this code that runs
				
				// 37 = weiter also nächstes item
				if(e === 37) {
					$("#link_prev").click();
				}
				// 39 = zurück also vorheriges item
				if(e === 39) {
					$("#link_next").click();
				}
				// 38+40 = hoch/runter also home, wenn esc -> home
				if(e === 38 || e === 40 || e === 27) {
					$("#link_home").click();
				}		
			}
			// holt sich die url parameter auf nachfrage entweder aus definierter oder browser url
			function getURLParameter(url = window.location.href) {
				var vars = {};
				var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
					vars[key] = value;
				});
				return vars;
			}
			// passt die index_size also rastergröße an wenn rotated
			function updateIndexSize(){
				var tmp = Math.floor( window.innerWidth / 102) * Math.floor( (window.innerHeight - 50) / 110);
				return index_size = tmp;
			}

			function displayFolder(link = window.location.href){
				$('#viewport').hide();
				$('#loading').show();
				$('#nav_help').hide();

				let item = getURLParameter(link)["item"];
				let folder = getURLParameter(link)["folder"];
				let item_index = getURLParameter(link)["start"];

				if( folder == null || folder == "" || folder == "undefined" ){
					folder = "items";
					item_index = 0;
				}

				document.title = "Gallery displaying: "+folder;
				history.pushState(null, null, location.href);
				index_size = updateIndexSize();
				
				// wechsel einzelansicht zu liste
				$('#viewport_item').hide();

				// clear old fullscreen item bevor going back
				$('#ajax_load').html('');

				//load overview
				$('#viewport_index').fadeIn('slow');
				
				// set background to black again as we are viewing the list
				$('body').css("background-color", "black");
				$("body").css('background-image', 'url(img/background.jpg)'); 
				
				$.ajax({
					url:"a_load_folder.php", 
					method: "POST",
					data: { folder: folder},
					success:function(data) {
						var result = $.parseJSON(data);
						var array_divider_position = result.indexOf("");
						var folders = result.slice(0, array_divider_position);
						var files = result.slice(array_divider_position + 1, result.length);

						// lade das file array für andere functionen auf
						jsFiles = files;

						// stelle sicher dass der angefragte ordner gespeichert wird
						var folder_link = folder;
						
						// passe den angefragte ordner an damit er intern als unterordner geladen werden kann
						if( folder != "items" && folder){
							folder = "items/"+ folder;
						}

						if( !item_index || item_index < 0 ){
							item_index = 0;
						}else if( (item_index * index_size) > files.length){
							item_index = Math.floor(files.length / index_size);
						}

						if( folders.length > index_size || files.length > index_size ){
							var prev = parseInt(item_index) - 1;
							var next = parseInt(item_index) + 1;
							
							$("#link_first").attr("href","?folder="+folder_link+"&start="+ 0);
							$("#link_prev").attr("href","?folder="+folder_link+"&start="+ prev );
							$("#link_home").attr("href","?folder=items");
							$("#link_next").attr("href","?folder="+folder_link+"&start="+ next );
							$("#link_last").attr("href","?folder="+folder_link+"&start="+ (Math.floor(files.length / index_size)) );
							$("[id^=link_]").show();
						}else{
							$("#link_home").attr("href","?folder=items");
							$("[id^=link_]").hide();
							$('#link_home').show();
						}

						//leere alte inhalte
						$("#folders").html('');
						$("#files").html('');

						//for (var i=0; i < folders.length; i++) {
						for (var i = 0; i < folders.length ; i++) {
							$("#files").append('<div class="index_item"><a class="nav" href="?folder='+folders[i]+'"><img id="item_'+folders[i]+'" class="thumb folder" src="'+thumb_folder+'" border="0" /></a>'+folders[i].substring(0, 10) + '...</div>');
						}

						//for (var i=0; i < files.length; i++) {
						for (var i= (item_index * index_size); i < (item_index * index_size + index_size); i++) {
							if( i >= files.length ){
								break;
							}

							if( files[i].split('.').pop() == 'mp4' ){
								$("#files").append('<div class="index_item"><a class="nav" href="?folder='+folder_link+'&item='+files[i]+'&start='+item_index+'"><img class="thumb video" src="'+thumb_video+'" alt="No Preview" border="0" /></a>'+files[i].substring(0, 10) + '...</div>');
							}else{
								$("#files").append('<div class="index_item"><a class="nav" href="?folder='+folder_link+'&item='+files[i]+'&start='+item_index+'"><img class="thumb picture" id="item_'+files[i]+'" src="'+thumb_picture+'" data-src="/thumbs/'+files[i]+'.jpg" border="0" /></a>'+files[i].substring(0, 10) + '...</div>');
							}
						}

						// lazy loading images
						var images= document.getElementsByClassName('picture');
						for (var i=0; i<images.length; i++) {
							if (images[i].getAttribute('data-src')) {
								images[i].setAttribute('src', images[i].getAttribute('data-src'));
							}
						}
						$('#loading').delay(50).fadeOut('slow');
						$('#viewport').fadeIn('slow');
					}
				});
			}
			
			function displayItem(link = window.location.href ){
				$('#viewport').hide();
				$('#loading').show();
				$("[id^=link_]").show();
				$('#nav_help').show();
				
				// wechsel Liste zu einzelansicht
				$('#viewport_index').hide();
				$('#viewport_item').fadeIn('slow');

				index_size = updateIndexSize();

				var item = getURLParameter(link)["item"];
				var folder = getURLParameter(link)["folder"];
				var start = getURLParameter(link)["start"];

				$.ajax({
					url:"a_load_folder.php", 
					method: "POST",
					cache: true,
					data: { folder: folder},
					success:function(data) {
						var result = $.parseJSON(data);
						var array_divider_position = result.indexOf("");
						var folders = result.slice(0, array_divider_position);
						var files = result.slice(array_divider_position + 1, result.length);

						// lade das file array für andere functionen auf
						jsFiles = files;

						// sucht den aktuellen index von unserem item
						index = jsFiles.indexOf(decodeURI(item));

						if( index >= index_size ){
							start = Math.trunc( index / index_size );
						}

						var item_first = jsFiles[0];
						var item_last = jsFiles[jsFiles.length - 1];
						var index_human = index + 1;

						// aktualisiert den websiten titel basierend auf den zahlen der dateien
						document.title = "Folder item "+index_human+" of "+jsFiles.length;

						// berechne den neuen link für das nächste item
						var item_next = index + 1;
						
						// wenn wir am ende der liste sind und weiter wollen -> von vorne
						if( item_next > (jsFiles.length - 1) ){
							item_next = 0;
						}
						item_next = jsFiles[item_next];

						// berechne den vorherigen link für das vorherige item
						var item_prev = index - 1;

						// wenn wir am anfang der liste sind und weiter zurück wollen -> nach hinten
						if(item_prev < 0 ){
							item_prev = jsFiles.length - 1;
						}
						item_prev = jsFiles[item_prev];

						// adaptiere die neuen links bevor folderpath angepasst wird
						$("#link_first").attr("href","?folder="+folder+"&item="+item_first+"&start="+start);
						$("#link_last").attr("href","?folder="+folder+"&item="+item_last+"&start="+start);
						$("#link_prev").attr("href","?folder="+folder+"&item="+item_prev+"&start="+start);
						$("#link_next").attr("href","?folder="+folder+"&item="+item_next+"&start="+start);
						$("#link_home").attr("href","?folder="+folder+"&start="+item_index+"&start="+start);

						// stelle sicher dass der angefragte ordner gespeichert wird
						var folder_link = folder;
						
						// passe den angefragte ordner an damit er intern als unterordner geladen werden kann
						if( folder != "items" && folder){
							folder = "items/"+ folder;
						}

						// clear old background image
						$("body").css('background-image', 'none');
						$('body').css("background-color", 'rgb(0,0,0)' );

						// prüfe ob es sich bei der dateiendung um mp4 handelt
						if( item.split('.').pop().toLowerCase() == 'mp4'){
							$('#ajax_load').html('<video id="fullscreen_element" controls="controls" autoplay="autoplay"><source src="/'+folder+'/'+item+'" type="video/mp4">Your browser does not support the video tag.</video>');
						}else{
							$('#ajax_load').html('<a class="nav" href="?folder='+folder_link+'&item='+item_next+'"><img id="fullscreen_element" src="/'+folder+'/'+item+'"></a>');
							$('#fullscreen_element').on('load', function() { 
								// finde die hauptfarbe des bildes und setze diese als background
								var rgb = getAverageRGB("fullscreen_element");

								$('body').css("background-color", 'rgb('+rgb.r+','+rgb.g+','+rgb.b+')' );
							});
						}

						$('#loading').delay(50).fadeOut('slow');
						$('#viewport').fadeIn('slow');
					}
				});
			}
					
			// starting jquery procedures
			$(document).ready(function() {
				$('#nav_arrows').attr("src", nav_arrows);
				$('#nav_fingers').attr("src", nav_fingers);

				// prüfe ob in browser url ein folder /item eingegeben wurde
				if (getURLParameter()["item"] != null) {
					displayItem();
				}else{	
					displayFolder();
				}

				history.pushState(null, null, location.href);
				window.onpopstate = function () {
					event.preventDefault();
					var link = $("#link_home").attr("href");
					displayFolder(link);
				}

				$(document).on("click","a.nav",function() {					
					event.preventDefault();

					// extrahiere aktuelles item was angezeigt werden soll
					var link = $(this).attr("href");

					if( getURLParameter(link)["item"] != null ){
						displayItem(link);
					}else{
						displayFolder(link);
					}
				});
				
				// catch arrow key input
				document.onkeydown = function(event) {
					event = event || window.event;
					handle(event.which);
				};

				// make sure on orientation change to adjust layout for folder and index_size
				window.addEventListener("orientationchange", function() {
					// nur neuladen wenn kein image offen is
					if( !document.getElementById("fullscreen_element") ){
						var folder = getURLParameter( $("#link_prev").attr("href") )["folder"];
						var start = parseInt( getURLParameter( $("#link_prev").attr("href") )["start"] ) + 1;
//alert("F : "+folder);
						setTimeout(function(){
							switch(window.orientation) {  
							case -90: case 90:
								displayFolder( "?folder="+folder+"&start="+start );
								break; 
							default:
								displayFolder( "?folder="+folder+"&start="+start );
								break; 
							}
						}, 250);
						//clearTimeout() ;
					}
				});
			});
		</script>
	</head>
	<body onload="detectswipe('swipe',handle)">
		<div id="loading">
			<div class="cssload-loader">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
		</div>
		<div id="viewport">
			<!-- TOP NAVIGATION -->
			<div id="navigation" class="center">
				<span><a class="nav" id="link_first">[ First ]</a>&nbsp;</span>
				<span><a class="nav" id="link_prev">[ <<< ]</a>&nbsp;</span>
				<span><a class="nav" id="link_home">[ Home ]</a>&nbsp;</span>
				<span><a class="nav" id="link_next">[ >>> ]</a>&nbsp;</span>
				<span><a class="nav" id="link_last">[ Last ]</a></span>

				<div id="nav_help">
					Use arrow keys <img id="nav_arrows" height="18px"> on your keyboard or your fingers <img id="nav_fingers" height="18px"> to swipe between images.
				</div>
			</div>
			<!-- FULLSCREEN ITEM -->
			<div id="viewport_item">
				<div class="center" id="swipe">
					<div id="ajax_load"></div>
				</div>		
			</div>
			<!-- ITEM LIST / INDEX -->
			<div id="viewport_index">
				<div class="center">
					<div id="folders" class="table tabindex"></div>
					<div class="linebreak"></div>
					<div id="files" class="table tabindex"></div>
				</div>
			</div>
		</div>
	</body>
</html>
<?
}else{
	include_once($login_redirect);
}
?>