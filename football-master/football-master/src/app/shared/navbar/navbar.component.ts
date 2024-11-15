import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {
  activePage: string = 'home';

  constructor(private router: Router) {}

  ngOnInit() {
    this.activePage = this.router.url.replace('/', '');
    if (this.activePage === '') this.activePage = 'home';
  }

  navigateTo(route: string) {
    this.activePage = route;
    this.router.navigateByUrl(route);
  }
}


