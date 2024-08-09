import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';

declare const $ : any;

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {

  constructor(private router : Router, private http : HttpClient) { }

  ngOnInit():void{ }

  showPeringatanModal(message: string): void {
    $('#peringatanModal').modal();
    $('#pm_message').html(message);
  }

  signIn(): void{
    console.log("signIn()");

    var userId = $("#idText").val();
    userId = encodeURIComponent(userId);

    var password = $("#passwordText").val();
    password = encodeURIComponent(password);

    var url = "http://127.0.0.1:8000/api/login" +
      "?id=" + userId +
      "&password=" + password;

    console.log("url : " + url);

    this.http.get(url)
      .subscribe((data : any) =>{
        console.log(data);
        
        var row = data[0];

        if (row.idCount != "1" && row.idCount != "2"){
          this.showPeringatanModal("Id atau Password tidak Cocok");
          return;
        }

        sessionStorage.setItem("userId", userId);
        sessionStorage.setItem("role", row.idCount == "1" ? "admin" : "sales");

        console.log("Session data berhasil dibuat");

        this.router.navigate(["/dashboard"])
      })
  }
}
