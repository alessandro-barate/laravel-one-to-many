Continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo e aggiungiamo una nuova entità Type: questa entità rappresenta la tipologia di progetto ed è in relazione one to many con i progetti.

I task da svolgere sono diversi, ma alcuni di essi sono un ripasso di ciò che abbiamo fatto nelle lezioni dei giorni scorsi:

-   creare la migration per la tabella types
-   creare il model Type
-   creare la migration di modifica per la tabella projects (io al posto di projects ho posts) per aggiungere la chiave esterna
-   aggiungere ai model Type e Project (Post) i metodi per definire la relazione one to many
-   visualizzare nella pagina di dettaglio di un progetto la tipologia associata, se presente
-   permettere all’utente di associare una tipologia nella pagina di creazione e modifica di un progetto
-   gestire il salvataggio dell’associazione progetto-tipologia con opportune regole di validazione

Bonus 1:
creare il seeder per il model Type.

Bonus 2:
aggiungere le operazioni CRUD per il model Type, in modo da gestire le tipologie di progetto direttamente dal pannello di amministrazione.

Buon lavoro e buon divertimento!

:saluto_vulcaniano:

# Roadmap per la gestione delle categorie e dei tags

-   [x] Creare tabella types (migration + model)
-   [x] Seeder per la tabella types -> array di dati
-   [x] Creare relazione tra tabella posts e tabella types (migration)
-   [x] Valutare tipo di relazione tra le tabelle (restricted, null, noaction)
-   [] Istruire Laravel sulla cardinalità / relazione tra posts e types
-   [] Modificare vista (create e update) e controller per creazione/modifica posts
-   [] Modificare vista (show) pe rappresentare le relazioni
-   [] Creare CRUD types
