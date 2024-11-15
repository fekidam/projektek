import { Component, Input } from '@angular/core';
import { Result } from '../models/result.model';
import { FirestoreService } from 'src/app/services/firestore.service';
import { MatDialog } from '@angular/material/dialog';
import { DialogComponent } from '../dialog/dialog.component';

@Component({
  selector: 'app-result-card',
  templateUrl: './result-card.component.html',
  styleUrls: ['./result-card.component.scss']
})
export class ResultCardComponent {
  @Input() result!: Result;

  constructor(
    private fireService: FirestoreService,
    private dialog: MatDialog
    ) {}

  onDelete() {
    this.fireService.deleteResult(this.result);
  }

  onEdit() {
    this.dialog.open(DialogComponent, {
      data: this.result
    })
  }
}
