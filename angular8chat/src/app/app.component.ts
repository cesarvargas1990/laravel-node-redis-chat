
import { environment } from './../environments/environment';
import { element } from 'protractor';
import { SocketioService } from './socketio.service';
import { Component,ElementRef,ViewChild } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})


export class AppComponent {

  data: any = [];

@ViewChild('mensaje', {static: true}) mensaje: ElementRef;  
   title = 'socketio-angular';
  constructor(private socketservice: SocketioService,private httpClient: HttpClient) { }
  ngOnInit() {
    this.socketservice.setupSocketConnection();
  }

  enviarMensaje () {
    
    let mensaje = this.mensaje.nativeElement.value 
    console.log ( mensaje)

      
    this.data.text = mensaje;
    this.httpClient.get<any>(environment.CHAT_ENDPOINT+'?text='+mensaje ).subscribe(
      response => {
        
        if (response) {
            if (response == true) {
              alert ('Se envio mensaje a todos');
            }
        }

      } 
    )

    
  }
}
