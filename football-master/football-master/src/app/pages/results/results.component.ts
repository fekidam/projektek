import { Component } from '@angular/core';
import { Result } from './models/result.model';
import { MatDialog } from '@angular/material/dialog';
import { DialogComponent } from './dialog/dialog.component';
import { FirestoreService } from 'src/app/services/firestore.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.scss']
})
export class ResultsComponent {

  public results$: Observable<Result[]> = this.fireService.getAllResults();

  constructor(
    public dialog: MatDialog,
    private fireService: FirestoreService
    ) { }

  openDialog() {
    this.dialog.open(DialogComponent);
  }
}
