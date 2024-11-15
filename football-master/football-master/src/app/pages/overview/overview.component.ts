import { Component } from '@angular/core';

import {MatTableDataSource} from '@angular/material/table';
import { Team } from './models/team.model';

const ELEMENT_DATA: Team[] = [
  {position: 1, name: 'Barcelona', points: 82, numberOfMatches: 33, wins: 26, losses: 3},
  {position: 2, name: 'Atlético Madrid', points: 69, numberOfMatches: 33, wins: 21, losses: 6},
  {position: 3, name: 'Real Madrid', points: 68, numberOfMatches: 33, wins: 21, losses: 7},
  {position: 4, name: 'Real Sociedad', points: 61, numberOfMatches: 33, wins: 18, losses: 7},
  {position: 5, name: 'Villareal', points: 54, numberOfMatches: 33, wins: 18, losses: 8},
  {position: 6, name: 'Betis', points: 52, numberOfMatches: 33, wins: 16, losses: 11},
  {position: 7, name: 'Girona', points: 47, numberOfMatches: 33, wins: 13, losses: 12},
  {position: 8, name: 'Bilbao', points: 47, numberOfMatches: 33, wins: 13, losses: 12},
  {position: 9, name: 'Rayo', points: 46, numberOfMatches: 33, wins: 12, losses: 11},
  {position: 10, name: 'Osasuna', points: 44, numberOfMatches: 33, wins: 12, losses: 13},
  {position: 11, name: 'Sevilla', points: 44, numberOfMatches: 33, wins: 12, losses: 13},
  {position: 12, name: 'Mallorca', points: 41, numberOfMatches: 33, wins: 11, losses: 14},
  {position: 13, name: 'Celta', points: 39, numberOfMatches: 33, wins: 11, losses: 14},
  {position: 14, name: 'Almería', points: 36, numberOfMatches: 33, wins: 10, losses: 17},
  {position: 15, name: 'Cádiz', points: 35, numberOfMatches: 33, wins: 8, losses: 14},
  {position: 16, name: 'Valladolid', points: 35, numberOfMatches: 33, wins: 10, losses: 18},
  {position: 17, name: 'Valencia', points: 34, numberOfMatches: 33, wins: 9, losses: 17},
  {position: 18, name: 'Getafe', points: 34, numberOfMatches: 33, wins: 8, losses: 15},
  {position: 19, name: 'Espanyol', points: 31, numberOfMatches: 33, wins: 7, losses: 16},
  {position: 20, name: 'Elche', points: 16, numberOfMatches: 33, wins: 3, losses: 23},
];
@Component({
  selector: 'app-overview',
  templateUrl: './overview.component.html',
  styleUrls: ['./overview.component.scss']
})
export class OverviewComponent {
  displayedColumns: string[] = ['position','name', 'points', 'numberOfMatches', 'wins', 'losses'];
  dataSource = new MatTableDataSource(ELEMENT_DATA);

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  onDeleteClick(row: Team) {
    const filteredArray = this.dataSource.data.filter(el => el.name !== row.name);
    this.dataSource = new MatTableDataSource(filteredArray);
  }
}
