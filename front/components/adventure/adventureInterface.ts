import { BookInterface } from "../book/bookInterface";
import { ParagraphInterface } from "../paragraph/paragraphInterface";

export interface AdventureInterface {
  id: string
  book: BookInterface
  paragraph: ParagraphInterface
}
