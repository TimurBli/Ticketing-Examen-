<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux genres musicaux 
 * 
 * @author Baptiste Pesquet
 */
class Ticket extends Modele {

    /** Renvoie la liste des tickets du ticketing
     * 
     * @return PDOStatement La liste des tickets
     */
    public function getTickets() {
        $sql = 'select TIC_ID as id, TIC_DATE as date,'
                . ' TIC_TITRE as titre, TIC_CONTENU as contenu , ETAT_LIB as lib from T_TICKET, T_ETAT'
                . ' where T_TICKET.ETAT_ID=T_ETAT.ETAT_ID ';          
        $tickets = $this->executerRequete($sql);
        return $tickets;
    }

    /** Renvoie les informations sur un ticket
     * 
     * @param int $id L'identifiant du ticket
     * @return array Le ticket
     * @throws Exception Si l'identifiant du ticket est inconnu
     */
    public function getTicket($idTicket) {
        $sql = 'select TIC_ID as id, TIC_DATE as date,'
                . ' TIC_TITRE as titre, TIC_CONTENU as contenu , ETAT_LIB as lib from T_TICKET, T_ETAT'
                . ' where TIC_ID=?';
              
        $ticket = $this->executerRequete($sql, array($idTicket));
        if ($ticket->rowCount() > 0)
            return $ticket->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun ticket ne correspond à l'identifiant '$idTicket'");

    }



}